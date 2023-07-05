<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\SuperAdmin\UsersController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/upload', [VideoController::class, 'upload'])->name('upload');

    // edit video
    Route::get('edit/{video}', [VideoController::class, 'edit'])->name('edit');
    Route::put('update/{video}', [VideoController::class, 'update'])->name('video.update');


    Route::get('/videos', [VideoController::class, 'videos'])->name('user.videos.index');
    Route::group(['prefix' => 'video'], function () {
        Route::post('/upload', [VideoController::class, 'store'])->name('video.upload');
    });

    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('remove/{video}', [VideoController::class, 'remove'])->name('remove');

    Route::get('view/{video}', [VideoController::class, 'view'])->name('view');

    Route::get('profile', [UserController::class, 'show'])->name('profile');
    Route::post('profile/update', [UserController::class, 'update'])->name('profile.update');

});

Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::get('videos', [\App\Http\Controllers\Admin\VideoController::class, 'index'])->name('admin.videos.index');
    Route::post('change_status/{video}', [\App\Http\Controllers\Admin\VideoController::class, 'changeStatus'])->name('admin.videos.change_status');
    Route::post('video/reject',[\App\Http\Controllers\Admin\VideoController::class,'reject'])->name('admin.video.reject');
    Route::get('video/{video}/approve',[\App\Http\Controllers\Admin\VideoController::class,'approve'])->name('admin.video.approve');
});

Route::group(['middleware' => 'role:super_admin','prefix' => 'superadmin'] , function () {
    Route::get('users',[UsersController::class,'index'])->name('superadmin.users.index');
    Route::get('user/{user}/remove',[UsersController::class,'remove'])->name('superadmin.user.delete');
    Route::get('user/{user}/assign/user',[UsersController::class,'assignUser'])->name('superadmin.user.assign_user');
    Route::post('user/{user}/remove_role',[UsersController::class,'removeRole'])->name('superadmin.user.remove_role');
    Route::get('user/{user}/assign/admin',[UsersController::class,'assignAdmin'])->name('superadmin.user.assign_admin');
    Route::get('user/{user}/assign/super_admin',[UsersController::class,'assignSuperAdmin'])->name('superadmin.user.assign_super_admin');

});


Route::get('help', [HelpController::class, 'show'])->name('route.help')->middleware('auth');
Auth::routes();

