<?php

use App\Http\Controllers\front\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[HomeController::class,'index'])->name('front.home');

Route::prefix('auth')->group(function(){
    Route::get('/register',[AccountController::class,'register'])->name('account.register');
    Route::post('/store',[AccountController::class,'registerstore'])->name('account.registerstore');
    Route::get('/',[AccountController::class,'login'])->name('account.login');
    Route::post('/dologin',[AccountController::class,'dologin'])->name('account.dologin');
    Route::get('/google/redirect', [AccountController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/google/callback', [AccountController::class, 'handleGoogleCallback'])->name('google.callback');
    Route::get('/accountprofile',[AccountController::class,'accountprofile'])->name('account.accountprofile');
    Route::get('/updateprofile',[AccountController::class,'updateprofile'])->name('account.updateprofile');
    Route::get('/logout',[AccountController::class,'logout'])->name('account.logout');


});