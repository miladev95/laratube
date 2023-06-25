<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/upload', [VideoController::class, 'upload'])->name('upload');

    // edit video
    Route::get('edit/{video}', [VideoController::class, 'edit'])->name('edit');
    Route::put('update/{video}',[VideoController::class,'update'])->name('video.update');


    Route::get('/videos', [VideoController::class, 'videos'])->name('videos');
    Route::group(['prefix' => 'video'], function () {
        Route::post('/upload', [VideoController::class, 'store'])->name('video.upload');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('dashboard',[DashboardController::class,'index'])->name('route.dashboard.index');

    Route::get('remove/{video}',[VideoController::class,'remove'])->name('remove');

});

Route::get('help', [HelpController::class, 'show'])->name('route.help')->middleware('auth');
Auth::routes();

