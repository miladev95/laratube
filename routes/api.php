<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function (){
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);



Route::get('/home',[HomeController::class,'index']);
