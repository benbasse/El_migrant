<?php
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout']);
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');

