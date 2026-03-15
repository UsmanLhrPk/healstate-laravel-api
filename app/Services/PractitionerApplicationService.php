<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Admin;
use App\Models\ApplicationDocument;
use App\Models\PractitionerApplication;
use App\Models\PractitionerProfile;
use App\Models\User;
use App\Notifications\ApplicationApprovedNotification;
use App\Notifications\ApplicationReceivedNotification;
use App\Notifications\ApplicationRejectedNotification;
use App\Notifications\NewApplicationAdminNotification;
use Illuminate\Support\Facades\DB;

class PractitionerApplicationService
{
    public function __construct(
        protected PractitionerAvailabilityService $availabilityService
    ) {}

    /**
     * Submit a new practitioner application.
     */
    public function submitApplication(User $user, array $data): PractitionerApplication
    {
        return DB::transaction(function () use ($user, $data) {
            $application = PractitionerApplication::create([
                'user_id'               => $user->id,
                'phone_number'          => $data['phone_number'],
                'professional_title'    => $data['professional_title'],
                'years_experience'      => $data['years_experience'],
                'bio'                   => $data['bio'],
                'license_number'        => $data['license_number'] ?? null,
                'issuing_organization'  => $data['issuing_organization'] ?? null,
                'primary_category_id'   => $data['primary_category_id'],
                'service_description'   => $data['service_description'],
                'availability_schedule' => $data['availability_schedule'],
                'timezone'              => $data['timezone'],
                'terms_agreed'          => filter_var($data['terms_agreed'], FILTER_VALIDATE_BOOLEAN),
                'terms_agreed_at'       => now(),
                'status'                => 'pending',
                'submitted_at'          => now(),
            ]);

            if (! empty($data['selected_services'])) {
                $application->services()->attach($data['selected_services']);
            }

            if (! empty($data['credentials'])) {
                foreach ($data['credentials'] as $credential) {
                    $this->uploadDocument($application, $credential);
                }
            }

            ActivityLog::log(
                $user->id,
                'application_submitted',
                'practitioner_application',
                $application->id,
                ['status' => 'pending']
            );

            $this->sendApplicationReceivedEmail($application);
            $this->sendNewApplicationAdminEmail($application);

            return $application;
        });
    }

    /**
     * Upload a credential document.
     */
    protected function uploadDocument(PractitionerApplication $application, array $credential): ApplicationDocument
    {
        $file = $credential['file'];
        $path = $file->store('practitioner-credentials/' . $application->id, 'private');

        return ApplicationDocument::create([
            'application_id'       => $application->id,
            'file_name'            => $file->getClientOriginalName(),
            'file_path'            => $path,
            'file_type'            => $file->getMimeType(),
            'file_size'            => $file->getSize(),
            'license_number'       => $credential['license_number'],
            'issuing_organization' => $credential['issuing_organization'],
        ]);
    }

    /**
     * Approve an application, create the practitioner profile,
     * and seed the live availability schedule (doubled).
     */
    public function approveApplication(
        PractitionerApplication $application,
        Admin $admin,
        ?string $adminNotes = null
    ): PractitionerProfile {
        return DB::transaction(function () use ($application, $admin, $adminNotes) {
            $application->update([
                'status'      => 'approved',
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
                'admin_notes' => $adminNotes,
            ]);

            // Create the profile with ALL data copied from the application
            $profile = PractitionerProfile::create([
                'user_id'               => $application->user_id,
                'application_id'        => $application->id,
                'phone_number'          => $application->phone_number,
                'professional_title'    => $application->professional_title,
                'years_experience'      => $application->years_experience,
                'bio'                   => $application->bio,
                'license_number'        => $application->license_number,
                'issuing_organization'  => $application->issuing_organization,
                'primary_category_id'   => $application->primary_category_id,
                'service_description'   => $application->service_description,
                'availability_schedule' => $application->availability_schedule,
                'timezone'              => $application->timezone,
                'is_active'             => true,
                'is_accepting_clients'  => true,
                'approved_at'           => now(),
            ]);

            // Copy services (subcategories) from the application to the profile
            $serviceIds = $application->services->pluck('id')->toArray();
            if (! empty($serviceIds)) {
                $profile->services()->attach($serviceIds);
            }

            // ── Seed live availability schedule ──────────────────────────────
            // Takes the weekly pattern from the application and creates two
            // consecutive week blocks (the automatic duplication requirement).
            if (! empty($application->availability_schedule)) {
                $this->availabilityService->createFromApplication(
                    $profile,
                    $application->availability_schedule
                );
            }

            $application->user->update(['is_practitioner' => true]);

            ActivityLog::log(
                $admin->id,
                'application_approved',
                'practitioner_application',
                $application->id,
                ['profile_id' => $profile->id]
            );

            $this->sendApplicationApprovedEmail($application);

            return $profile;
        });
    }

    /**
     * Reject an application.
     */
    public function rejectApplication(
        PractitionerApplication $application,
        Admin $admin,
        ?string $rejectionReason = null,
        ?string $adminNotes = null
    ): PractitionerApplication {
        return DB::transaction(function () use ($application, $admin, $rejectionReason, $adminNotes) {
            $application->update([
                'status'           => 'rejected',
                'reviewed_by'      => $admin->id,
                'reviewed_at'      => now(),
                'rejection_reason' => $rejectionReason,
                'admin_notes'      => $adminNotes,
            ]);

            ActivityLog::log(
                $admin->id,
                'application_rejected',
                'practitioner_application',
                $application->id,
                ['reason' => $rejectionReason]
            );

            $this->sendApplicationRejectedEmail($application);

            return $application;
        });
    }

    /**
     * Get pending applications for admin review.
     */
    public function getPendingApplications()
    {
        return PractitionerApplication::with([
            'user',
            'primaryCategory',
            'services',
            'documents',
        ])
            ->pending()
            ->orderBy('submitted_at', 'asc')
            ->get();
    }

    /**
     * Get application by ID with relations.
     */
    public function getApplicationById(int $id): ?PractitionerApplication
    {
        return PractitionerApplication::with([
            'user',
            'primaryCategory',
            'services',
            'documents',
            'reviewer',
        ])->find($id);
    }

    /**
     * Check if user has a pending application.
     */
    public function userHasPendingApplication(User $user): bool
    {
        return PractitionerApplication::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();
    }

    protected function sendApplicationReceivedEmail(PractitionerApplication $application): void
    {
        $application->user->notify(new ApplicationReceivedNotification($application));
    }

    protected function sendNewApplicationAdminEmail(PractitionerApplication $application): void
    {
        $admins = \App\Models\Admin::all();
        foreach ($admins as $admin) {
            $admin->notify(new NewApplicationAdminNotification($application));
        }
    }

    protected function sendApplicationApprovedEmail(PractitionerApplication $application): void
    {
        $application->user->notify(new ApplicationApprovedNotification($application));
    }

    protected function sendApplicationRejectedEmail(PractitionerApplication $application): void
    {
        $application->user->notify(new ApplicationRejectedNotification($application));
    }
}