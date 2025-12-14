<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', function() {
    return csrf_token();
});

Route::get('/test/{id}', [CampaignController::class, 'updateCurrentTotal']);

Route::get('/donors/topFiveLastThirtyDays', [DonorController::class, 'topFiveLastThirtyDays'])->name('donors.topFiveLastThirtyDays');
Route::get('/donors/{id}', [DonorController::class, 'show'])->name('donors.show');
Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');
Route::put('/donors/update/{id}', [DonorController::class, 'update'])->name('donors.update');
Route::post('/donors', [DonorController::class, 'store'])->name('donors.store');
Route::delete('/donors/delete/{id}', [DonorController::class, 'delete'])->name('donors.delete');

Route::get('/campaigns/total/{id}', [CampaignController::class, 'totalDonated'])->name('campaigns.totalDonated');
Route::get('/campaigns/{id}', [CampaignController::class, 'show'])->name('campaigns.show');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::put('/campaigns/update/{id}', [CampaignController::class, 'update'])->name('campaigns.update');
Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
Route::delete('/campaigns/delete/{id}', [CampaignController::class, 'delete'])->name('campaigns.delete');

Route::get('/donations/{id}', [DonationController::class, 'show'])->name('donations.show');
Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
Route::put('/donations/update/{id}', [DonationController::class, 'update'])->name('donations.update');
Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
Route::delete('/donations/delete/{id}', [DonationController::class, 'delete'])->name('donations.delete');