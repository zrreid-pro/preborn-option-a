<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventLogController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/main', function() {
    return view('main');
})->name('main');

Route::get('/token', function() {
    return csrf_token();
});

Route::get('/donors/topFiveLastThirtyDays', [DonorController::class, 'topFiveLastThirtyDays'])->name('donors.topFiveLastThirtyDays');
Route::get('/donors/create', [DonorController::class, 'create'])->name('donors.create');
Route::get('/donors/{id}', [DonorController::class, 'show'])->name('donors.show');
Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');
Route::put('/donors/{id}/update', [DonorController::class, 'update'])->name('donors.update');
Route::post('/donors', [DonorController::class, 'store'])->name('donors.store');
Route::delete('/donors/{id}/delete', [DonorController::class, 'delete'])->name('donors.delete');

Route::get('/campaigns/totalPerCampaign', [CampaignController::class, 'totalDonatedPerCampaign'])->name('campaigns.totalDonatedPerCampaign');
Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
Route::get('/campaigns/{id}', [CampaignController::class, 'show'])->name('campaigns.show');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::put('/campaigns/{id}/update', [CampaignController::class, 'update'])->name('campaigns.update');
Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
Route::delete('/campaigns/{id}/delete', [CampaignController::class, 'delete'])->name('campaigns.delete');

Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
Route::get('/donations/{id}', [DonationController::class, 'show'])->name('donations.show');
Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
Route::put('/donations/{id}/update', [DonationController::class, 'update'])->name('donations.update');
Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
Route::delete('/donations/{id}/delete', [DonationController::class, 'delete'])->name('donations.delete');

Route::get('/events', [EventLogController::class, 'index'])->name('events.index');