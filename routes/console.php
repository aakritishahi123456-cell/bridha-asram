<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// NGO-specific scheduled tasks
Schedule::command('ngo:send-donation-receipts')->daily();
Schedule::command('ngo:update-impact-metrics')->daily();
Schedule::command('ngo:cleanup-expired-sessions')->weekly();
Schedule::command('ngo:backup-database')->daily()->at('02:00');