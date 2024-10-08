<?php

use App\Http\Controllers\API\AideController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DonController;
use App\Http\Controllers\API\SignalementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me']);

// Route::get('aides', [AideController::class, 'index']);
Route::post('aide', [AideController::class, 'store']);
Route::get('aide/{id}', [AideController::class, 'show']);
Route::put('aide/{id}', [AideController::class, 'update']);
Route::delete('aide/{id}', [AideController::class, 'destroy']);

Route::get('dons', [DonController::class, 'index']);
Route::post('don', [DonController::class, 'store']);
Route::get('don/{id}', [DonController::class, 'show']);
Route::put('don/{id}', [DonController::class, 'update']);
Route::delete('don/{id}', [DonController::class, 'destroy']);


Route::get('signalements', [SignalementController::class, 'index']);
Route::post('signalement', [SignalementController::class, 'store']);
Route::get('signalement/{id}', [SignalementController::class, 'show']);
// Route::put('signalement/{id}', [SignalementController::class, 'updade']);
Route::delete('signalement/{id}', [SignalementController::class, 'destroy']);


Route::get('aides', [AideController::class, 'index']);

Route::middleware(['auth:api', 'admin'])->group(function () {
});
