<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    CampaignController::updateStatus();
})->dailyAt('00:00')->timezone('America/New_York')->name('Campaign_Status_Update')->withoutOverlapping();
