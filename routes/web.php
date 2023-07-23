<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('auth')->group(function () {

    // edit video
    Route::put('update/{video}', [VideoController::class, 'update'])->name('video.update');


    Route::group(['prefix' => 'video'], function () {
    });

    Route::get('remove/{video}', [VideoController::class, 'remove'])->name('remove');

    Route::get('view/{video}', [VideoController::class, 'view'])->name('view');

    Route::get('profile', [UserController::class, 'show'])->name('profile');
    Route::post('profile/update', [UserController::class, 'update'])->name('profile.update');

});







