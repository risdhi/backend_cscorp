<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\SosmedController;
use App\Http\Controllers\Api\VisionController;

Route::get('/clients', [ClientController::class, 'index']);
Route::get('/contacs', [ContactController::class, 'index']);
Route::get('/locations', [LocationController::class, 'index']);
Route::get('/sosmeds', [SosmedController::class, 'index']);
Route::get('/visions', [VisionController::class, 'index']);