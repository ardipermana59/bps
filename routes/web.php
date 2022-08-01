<?php

use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PenilaiController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\PenilaiPegawaiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Penilai\NilaiPegawaiController;
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
    
    // Halaman Pegawai
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('employee.index');
    Route::delete('/pegawai', [PegawaiController::class, 'destroy'])->name('employee.destroy');

    // Halaman Penilai
    Route::get('/penilai', [PenilaiController::class, 'index'])->name('penilai.index');
    Route::delete('/penilai', [PenilaiController::class, 'destroy'])->name('penilai.destroy');

    // Halaman Jabatan
    Route::get('/jabatan', [JabatanController::class, 'index'])->name('position.index');
    Route::get('/jabatan/edit/{id}', [JabatanController::class, 'edit'])->name('position.edit');
    Route::put('/jabatan/{id}', [JabatanController::class, 'update'])->name('position.update');
    Route::get('/jabatan/tambah-jabatan', [JabatanController::class, 'create'])->name('position.create');
    Route::post('/jabatan', [JabatanController::class, 'store'])->name('position.store');
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy'])->name('position.destroy');

    // Halaman Kegiatan
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('activity.index');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('activity.destroy');

    // Halaman Kriteria Penilaian
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('criteria.index');
    Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('criteria.destroy');

    // Halaman struktur penilai pegawai
    Route::get('/struktur-penilai', [PenilaiPegawaiController::class, 'index'])->name('struktur.index');

    // Halaman Manajemen User
    Route::get('/manajemen-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/manajemen-user/tambah-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/manajemen-user', [UserController::class, 'store'])->name('user.store');
    Route::delete('/manajemen-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Halaman Laporan
    Route::view('/laporan', 'pages.admin.laporan.index')->name('laporan.index');
});

Route::get('/nilai/pegawai', [NilaiPegawaiController::class, 'index'])->name('nilai.index');

Route::middleware(['auth','isAdmin:staff'])->group(function () {
   // route buat staff
});
Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
]);