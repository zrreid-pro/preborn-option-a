<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/donors/{id}', [DonorController::class, 'show'])->name('donors.show');
Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');
