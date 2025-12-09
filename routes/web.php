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

Route::get('/donors/{id}', [DonorController::class, 'show'])->name('donors.show');
Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');
Route::post('/donors', [DonorController::class, 'store'])->name('donors.store');


Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
