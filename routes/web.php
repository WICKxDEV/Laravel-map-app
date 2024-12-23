<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::get('/', [LocationController::class, 'index'])->name('locations.index');
Route::post('/store', [LocationController::class, 'store'])->name('locations.store');
