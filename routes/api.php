<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login.login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout.logout');