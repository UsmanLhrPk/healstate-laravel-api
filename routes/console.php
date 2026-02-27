<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Send booking reminders every 30 minutes
// Checks for bookings happening in ~24 hours and ~1 hour
Schedule::command('bookings:send-reminders')->everyThirtyMinutes();