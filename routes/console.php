<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\CampaignController;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function() {
    CampaignController::updateStatus();
})->dailyAt('00:00')->timezone('America/New_York')->name('Campaign_Status_Update')->withoutOverlapping();
