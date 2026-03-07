<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PractitionerAvailabilitySchedule extends Model
{
    protected $fillable = [
        'practitioner_profile_id',
        'week_start_date',
        'week_end_date',
        'weekly_pattern',
        'is_active',
        'skipped_dates',
        'source',
    ];

    protected $casts = [
        'week_start_date' => 'date',
        'week_end_date'   => 'date',
        'weekly_pattern'  => 'array',
        'is_active'       => 'boolean',
        'skipped_dates'   => 'array',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function practitionerProfile(): BelongsTo
    {
        return $this->belongsTo(PractitionerProfile::class);
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    /**
     * Check whether a specific date is covered by this week block.
     */
    public function coversDate(string $date): bool
    {
        $d = Carbon::parse($date);
        return $d->gte($this->week_start_date) && $d->lte($this->week_end_date);
    }

    /**
     * Check whether a specific date has been skipped.
     */
    public function isDateSkipped(string $date): bool
    {
        return in_array($date, $this->skipped_dates ?? []);
    }

    /**
     * Add a date to skipped_dates and persist.
     */
    public function skipDate(string $date): void
    {
        $skipped = $this->skipped_dates ?? [];
        if (! in_array($date, $skipped)) {
            $skipped[] = $date;
            sort($skipped);
            $this->update(['skipped_dates' => $skipped]);
        }
    }

    /**
     * Remove a date from skipped_dates and persist.
     */
    public function unskipDate(string $date): void
    {
        $skipped = array_values(array_filter(
            $this->skipped_dates ?? [],
            fn ($d) => $d !== $date
        ));
        $this->update(['skipped_dates' => $skipped]);
    }

    /**
     * Get the day schedule for a given date (by day-of-week name).
     * Returns null if the date is not covered, is skipped, or the day is unavailable.
     */
    public function getDaySchedule(string $date): ?array
    {
        if (! $this->coversDate($date)) return null;
        if (! $this->is_active)         return null;
        if ($this->isDateSkipped($date)) return null;

        $dayName = strtolower(Carbon::parse($date)->format('l')); // e.g. "monday"
        $pattern = $this->weekly_pattern;

        if (empty($pattern[$dayName])) return null;

        $day = $pattern[$dayName];
        if (empty($day['is_available']) || empty($day['time_slots'])) return null;

        return $day;
    }

    // ── Scopes ─────────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCoveringDate($query, string $date)
    {
        return $query->where('week_start_date', '<=', $date)
                     ->where('week_end_date', '>=', $date);
    }

    public function scopeForProfile($query, int $profileId)
    {
        return $query->where('practitioner_profile_id', $profileId);
    }
}