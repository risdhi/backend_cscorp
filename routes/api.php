<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\SosmedController;
use App\Http\Controllers\Api\VisionController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ProductionController;
use App\Http\Controllers\Api\StructuralController;

//clients API
Route::get('/clients', [ClientController::class, 'index']);

//contacts API
Route::get('/contacs', [ContactController::class, 'index']);

//locations API
Route::get('/locations', [LocationController::class, 'index']);

//sosmed API
Route::get('/sosmeds', [SosmedController::class, 'index']);

//visions API
Route::get('/visions', [VisionController::class, 'index']);

//events API
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);

//productions API
Route::get('/productions', [ProductionController::class, 'index']);
Route::get('/productions/{id}', [ProductionController::class, 'show']);

//structurals API
Route::get('/structurals', [StructuralController::class, 'index']);
Route::get('/structurals/{id}', [StructuralController::class, 'show']);