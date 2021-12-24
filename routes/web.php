<?php

use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SBAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home2', [HomeController::class, 'index2'])->name('home2');

Auth::routes();

Route::group(['prefix' => '/sb-admin-tmp'], function () {
    Route::get('/', [SBAdminController::class, 'index'])->name('sb-admin-tmp.index');
    Route::get('/layout-static', [SBAdminController::class, 'layoutStatic'])->name('sb-admin-tmp.layout-static');
    Route::get('/layout-sidenav-light', [SBAdminController::class, 'layoutSidenavLight'])->name('sb-admin-tmp.layout-sidenav-light');
    Route::get('/charts', [SBAdminController::class, 'charts'])->name('sb-admin-tmp.charts');
    Route::get('/tables', [SBAdminController::class, 'tables'])->name('sb-admin-tmp.tables');
    Route::get('/login', [SBAdminController::class, 'login'])->name('sb-admin-tmp.login');
    Route::get('/register', [SBAdminController::class, 'register'])->name('sb-admin-tmp.register');
    Route::get('/password', [SBAdminController::class, 'password'])->name('sb-admin-tmp.password');
    Route::get('/error401', [SBAdminController::class, 'error401'])->name('sb-admin-tmp.error401');
    Route::get('/error404', [SBAdminController::class, 'error404'])->name('sb-admin-tmp.error404');
    Route::get('/error500', [SBAdminController::class, 'error500'])->name('sb-admin-tmp.error500');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function() {
    Route::get('/', function () {
        return redirect()->route('login');
    })->name('admin.redirect');

    Route::name('admin.')->group(function () {
        Route::resource('roles', AdminRoleController::class);
        Route::get('/users-password/{user}', [AdminUserController::class, 'editPassword'])->name('users.edit-password');
        Route::post('/users-password/{user}', [AdminUserController::class, 'updatePassword'])->name('users.update-password');
        Route::resource('users', AdminUserController::class);
    });




});


