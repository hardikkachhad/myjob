<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/signup',[AuthController::class,'register']);
Route::post('/signin',[AuthController::class,'dologin']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

