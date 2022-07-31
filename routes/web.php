<?php

use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PenilaiController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
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


Route::middleware(['auth','isAdmin:admin'])->group(function () {
    Route::view('/', 'pages.dashboard')->name('dashboard');

    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('employee.index');
    Route::delete('/pegawai', [PegawaiController::class, 'destroy'])->name('employee.destroy');


    Route::get('/penilai', [PenilaiController::class, 'index'])->name('penilai.index');
    Route::delete('/penilai', [PenilaiController::class, 'destroy'])->name('penilai.destroy');

    Route::get('/jabatan', [JabatanController::class, 'index'])->name('position.index');
    Route::get('/jabatan/tambah-jabatan', [JabatanController::class, 'create'])->name('position.create');
    Route::post('/jabatan', [JabatanController::class, 'store'])->name('position.store');
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy'])->name('position.destroy');

    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('activity.index');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('activity.destroy');

    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('criteria.index');
    Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('criteria.destroy');

    Route::view('/struktur-penilai', 'pages.struktur.index')->name('struktur.index');

    Route::get('/manajemen-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/manajemen-user/tambah-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/manajemen-user', [UserController::class, 'store'])->name('user.store');
    Route::delete('/manajemen-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::view('/laporan', 'pages.laporan.index')->name('laporan.index');
});

Route::middleware(['auth','isAdmin:staff'])->group(function () {
   // route buat staff
});
Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
]);

// Route::get('/home', 'HomeController@index')->name('home');
