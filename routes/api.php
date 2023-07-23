<?php

use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\VideoController as UserVideoController;
use Illuminate\Support\Facades\Route;

Route::middleware('authenticated')->group(function (){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/home',[HomeController::class,'index']);


    Route::group(['middleware' => 'role:super_admin','prefix' => 'superadmin'] , function () {
        Route::get('users',[UsersController::class,'index']);
        Route::get('user/{user}/remove',[UsersController::class,'remove']);
        Route::get('user/{user}/assign/user',[UsersController::class,'assignUser']);
        Route::post('user/{user}/remove_role',[UsersController::class,'removeRole']);
        Route::get('user/{user}/assign/admin',[UsersController::class,'assignAdmin']);
        Route::get('user/{user}/assign/super_admin',[UsersController::class,'assignSuperAdmin']);
    });


    Route::group(['middleware' => 'admin.or.superadmin', 'prefix' => 'admin'], function () {
        Route::get('videos', [AdminVideoController::class, 'index']);
        Route::post('change_status/{video}', [AdminVideoController::class, 'changeStatus']);
        Route::post('video/reject',[AdminVideoController::class,'reject']);
        Route::get('video/{video}/approve',[AdminVideoController::class,'approve']);
    });


    Route::get('/videos', [UserVideoController::class, 'videos']);
    Route::post('/upload', [UserVideoController::class, 'store']);

});

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);



