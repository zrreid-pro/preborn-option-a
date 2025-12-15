<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventLogController;



// Route::redirect('/', 'login');
Route::get('/main', function () {
    return view('main');
})->middleware('auth:sanctum')->name('main');

Route::get('/login', function() {
    return view('welcome');
})->name('login');

// Route::get('/main', function() {
//     return view('main');
// })->middleware('auth:sanctum')->name('main');

Route::get('/token', function() {
    return csrf_token();
});

Route::get('/donors/topFiveLastThirtyDays', [DonorController::class, 'topFiveLastThirtyDays'])->name('donors.topFiveLastThirtyDays');
Route::get('/donors/create', [DonorController::class, 'create'])->name('donors.create');
Route::get('/donors/{id}', [DonorController::class, 'show'])->name('donors.show');
Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');
Route::put('/donors/update/{id}', [DonorController::class, 'update'])->name('donors.update');
Route::post('/donors', [DonorController::class, 'store'])->middleware('auth:sanctum')->name('donors.store');
Route::delete('/donors/delete/{id}', [DonorController::class, 'delete'])->middleware('auth:sanctum')->name('donors.delete');

Route::get('/campaigns/total/{id}', [CampaignController::class, 'totalDonated'])->name('campaigns.totalDonated');
Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
Route::get('/campaigns/{id}', [CampaignController::class, 'show'])->name('campaigns.show');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::put('/campaigns/update/{id}', [CampaignController::class, 'update'])->middleware('auth:sanctum')->name('campaigns.update');
Route::post('/campaigns', [CampaignController::class, 'store'])->middleware('auth:sanctum')->name('campaigns.store');
Route::delete('/campaigns/delete/{id}', [CampaignController::class, 'delete'])->middleware('auth:sanctum')->name('campaigns.delete');

Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
Route::get('/donations/{id}', [DonationController::class, 'show'])->name('donations.show');
Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
Route::put('/donations/update/{id}', [DonationController::class, 'update'])->middleware('auth:sanctum')->name('donations.update');
Route::post('/donations', [DonationController::class, 'store'])->middleware('auth:sanctum')->name('donations.store');
Route::delete('/donations/delete/{id}', [DonationController::class, 'delete'])->middleware('auth:sanctum')->name('donations.delete');

Route::get('/events', [EventLogController::class, 'index'])->name('events.index');