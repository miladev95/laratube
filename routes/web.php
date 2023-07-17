<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyDashboard;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
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

Route::get('/',[HomeController::class,'index'])->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/upload', [VideoController::class, 'upload'])->name('upload');

    // edit video
    Route::get('edit/{video}', [VideoController::class, 'edit'])->name('edit');
    Route::put('update/{video}', [VideoController::class, 'update'])->name('video.update');


    Route::get('/videos', [VideoController::class, 'videos'])->name('user.videos.index');
    Route::group(['prefix' => 'video'], function () {
        Route::post('/upload', [VideoController::class, 'store'])->name('video.upload');
    });

    Route::get('my_dashboard', [App\Http\Controllers\MyDashboard::class, 'index'])->name('my_dashboard');

    Route::get('remove/{video}', [VideoController::class, 'remove'])->name('remove');

    Route::get('view/{video}', [VideoController::class, 'view'])->name('view');

    Route::get('profile', [UserController::class, 'show'])->name('profile');
    Route::post('profile/update', [UserController::class, 'update'])->name('profile.update');

});

Route::group(['middleware' => 'role:admin,super_admin', 'prefix' => 'admin'], function () {
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



Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});
