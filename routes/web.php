<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\VisualController;
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
        Route::post('/create', 'createAction')->name('create.action');
        Route::get('/update/{id_pengguna}', 'updateView')->name('update.view');
        Route::put('/update/{id_pengguna}', 'updateAction')->name('update.action');
        Route::get('/delete/{id_pengguna}', 'deleteAction')->name('delete.action');
        Route::get('/datatables', 'datatables')->name('datatables');
    });

    // route visual
    Route::controller(VisualController::class)->prefix('visual')->name('visual.')->group(function () {
        Route::get('/data-calon-mahasiswa', 'dataCalonMahasiswa')->name('data.calon.mahasiswa');
        Route::get('/data-sebaran-calon-mahasiswa', 'dataSebaranCalonMahasiswa')->name('data.sebaran.calon.mahasiswa');

        Route::prefix('detail')->group(function () {
            Route::get('/asal-kota-sekolah', 'asalKotaSekolah')->name('data.asal.kota.sekolah');
            Route::get('/jurusan-asal-sekolah-sma', 'jurusanAsalSekolahSma')->name('data.jurusan.asal.sekolah.sma');
            Route::get('/jurusan-asal-sekolah-ma', 'jurusanAsalSekolahMa')->name('data.jurusan.asal.sekolah.ma');
            Route::get('/jurusan-asal-sekolah-smk', 'jurusanAsalSekolahSmk')->name('data.jurusan.asal.sekolah.smk');
        });
    });

    // route laporan
    Route::controller(LaporanController::class)->prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/pdf', 'laporanGeneratePDF')->name('pdf');
    });
});
