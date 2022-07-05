<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
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
    return redirect()->route('auth.login.view');
});

// route auth
Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', 'loginView')->name('login.view');
    Route::post('/login', 'loginAction')->name('login.action');
    Route::get('/logout', 'logoutAction')->name('logout.action');
});

// route dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // route pengguna
    Route::controller(PenggunaController::class)->prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'createView')->name('create.view');
        Route::get('/update', 'updateView')->name('update.view');
    });
});
