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
    /**
     * Submit a new practitioner application.
     */
    public function submitApplication(User $user, array $data): PractitionerApplication
    {
        return DB::transaction(function () use ($user, $data) {
            // Create the application
            $application = PractitionerApplication::create([
                'user_id' => $user->id,
                'phone_number' => $data['phone_number'],
                'professional_title' => $data['professional_title'],
                'years_experience' => $data['years_experience'],
                'bio' => $data['bio'],
                'license_number' => $data['license_number'] ?? null,
                'issuing_organization' => $data['issuing_organization'] ?? null,
                'primary_category_id' => $data['primary_category_id'],
                'service_description' => $data['service_description'],
                'availability_schedule' => $data['availability_schedule'],
                'timezone' => $data['timezone'],
                'terms_agreed' => filter_var($data['terms_agreed'], FILTER_VALIDATE_BOOLEAN),
                'terms_agreed_at' => now(),
                'status' => 'pending',
                'submitted_at' => now(),
            ]);

            // Attach selected services
            if (! empty($data['selected_services'])) {
                $application->services()->attach($data['selected_services']);
            }

            // Upload and attach documents
            if (! empty($data['credentials'])) {
                foreach ($data['credentials'] as $credential) {
                    $this->uploadDocument($application, $credential);
                }
            }

            // Log the activity
            ActivityLog::log(
                $user->id,
                'application_submitted',
                'practitioner_application',
                $application->id,
                ['status' => 'pending']
            );

            // Send email notifications
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
        $path = $file->store('practitioner-credentials/'.$application->id, 'private');

        return ApplicationDocument::create([
            'application_id' => $application->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'license_number' => $credential['license_number'],
            'issuing_organization' => $credential['issuing_organization'],
        ]);
    }

    /**
     * Approve an application.
     */
    public function approveApplication(PractitionerApplication $application, Admin $admin, ?string $adminNotes = null): PractitionerProfile
    {
        return DB::transaction(function () use ($application, $admin, $adminNotes) {
            // Update application status
            $application->update([
                'status' => 'approved',
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
                'admin_notes' => $adminNotes,
            ]);

            // Create practitioner profile (minimal data, reference the application)
            $profile = PractitionerProfile::create([
                'user_id' => $application->user_id,
                'application_id' => $application->id,
                'approved_at' => now(),
                // Add any other fields that actually exist in practitioner_profiles table
            ]);

            // Copy services to profile
            $serviceIds = $application->services->pluck('id')->toArray();
            $profile->services()->attach($serviceIds);

            // Update user's practitioner flag
            $application->user->update(['is_practitioner' => true]);

            // Log the activity
            ActivityLog::log(
                $admin->id,
                'application_approved',
                'practitioner_application',
                $application->id,
                ['profile_id' => $profile->id]
            );

            // Send approval email
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
            // Update application status
            $application->update([
                'status' => 'rejected',
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
                'rejection_reason' => $rejectionReason,
                'admin_notes' => $adminNotes,
            ]);

            // Log the activity
            ActivityLog::log(
                $admin->id,
                'application_rejected',
                'practitioner_application',
                $application->id,
                ['reason' => $rejectionReason]
            );

            // Send rejection email
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

    /**
     * Send application received email to applicant.
     */
    protected function sendApplicationReceivedEmail(PractitionerApplication $application): void
    {
        $application->user->notify(new ApplicationReceivedNotification($application));
    }

    /**
     * Send new application notification to admin.
     */
    protected function sendNewApplicationAdminEmail(PractitionerApplication $application): void
    {
        // Get all admin users from admins table
        $admins = Admin::all();

        foreach ($admins as $admin) {
            $admin->notify(new NewApplicationAdminNotification($application));
        }
    }

    /**
     * Send application approved email to applicant.
     */
    protected function sendApplicationApprovedEmail(PractitionerApplication $application): void
    {
        $application->user->notify(new ApplicationApprovedNotification($application));
    }

    /**
     * Send application rejected email to applicant.
     */
    protected function sendApplicationRejectedEmail(PractitionerApplication $application): void
    {
        $application->user->notify(new ApplicationRejectedNotification($application));
    }
}
