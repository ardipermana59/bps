<?php

use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PenilaiController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenilaiPegawaiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Pegawai\KegiatanPegawaiController;
use App\Http\Controllers\Penilai\KegiatanPenilaiController;
use App\Http\Controllers\profileController;
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

Route::middleware(['auth'])->group(function () {

   
    Route::view('/','pages.dashboard')->name('dashboard');

    Route::get('/pengaturan/password/ubah', [ChangePasswordController::class,'index'])->name('password.index');
    Route::post('/pengaturan/password/ubah', [ChangePasswordController::class,'update'])->name('password.change');

    Route::get('/pengaturan/profile/ubah', [profileController::class,'index'])->name('profile.index');
    Route::post('/pengaturan/profile/ubah', [profileController::class,'update'])->name('profile.change');


    Route::middleware(['isAdmin:admin'])->group(function () {
        // Halaman Pegawai
        Route::get('/pegawai', [PegawaiController::class, 'index'])->name('employee.index');
        Route::get('/pegawai/tambah-pegawai', [PegawaiController::class, 'create'])->name('employee.create');
        Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('employee.edit');
        Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('employee.update');
        Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('employee.destroy');

        // Halaman Penilai
        Route::get('/penilai', [PenilaiController::class, 'index'])->name('penilai.index');
        Route::get('/penilai/edit/{id}', [PenilaiController::class, 'edit'])->name('penilai.edit');
        Route::put('/penilai/{id}', [PenilaiController::class, 'update'])->name('penilai.update');
        Route::get('/penilai/tambah-kegiatan', [PenilaiController::class, 'create'])->name('penilai.create');
        Route::post('/penilai', [PenilaiController::class, 'store'])->name('penilai.store');
        Route::delete('/penilai/{id}', [PenilaiController::class, 'destroy'])->name('penilai.destroy');

        // Halaman Jabatan
        Route::get('/jabatan', [JabatanController::class, 'index'])->name('position.index');
        Route::get('/jabatan/edit/{id}', [JabatanController::class, 'edit'])->name('position.edit');
        Route::put('/jabatan/{id}', [JabatanController::class, 'update'])->name('position.update');
        Route::get('/jabatan/tambah-jabatan', [JabatanController::class, 'create'])->name('position.create');
        Route::post('/jabatan', [JabatanController::class, 'store'])->name('position.store');
        Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy'])->name('position.destroy');

        // Halaman Kegiatan
        Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('activity.index');
        Route::get('/kegiatan/edit/{id}', [KegiatanController::class, 'edit'])->name('activity.edit');
        Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('activity.update');
        Route::get('/kegiatan/tambah-kegiatan', [KegiatanController::class, 'create'])->name('activity.create');
        Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('activity.store');
        Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('activity.destroy');

        // Halaman struktur penilai pegawai
        Route::get('/struktur-penilai', [PenilaiPegawaiController::class, 'index'])->name('struktur.index');
        Route::get('/struktur/edit/{id}', [PenilaiPegawaiController::class, 'edit'])->name('struktur.edit');
        Route::put('/struktur/{id}', [PenilaiPegawaiController::class, 'update'])->name('struktur.update');
        Route::get('/struktur/tambah-struktur', [PenilaiPegawaiController::class, 'create'])->name('struktur.create');
        Route::post('/struktur', [PenilaiPegawaiController::class, 'store'])->name('struktur.store');
        Route::delete('/struktur/{id}', [PenilaiPegawaiController::class, 'destroy'])->name('struktur.destroy');

        // Halaman Manajemen User
        Route::get('/manajemen-user', [UserController::class, 'index'])->name('user.index');
        Route::get('/manajemen-user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('/manajemen-user/tambah-user', [UserController::class, 'create'])->name('user.create');
        Route::put('/manajemen-user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/manajemen-user/tambah-user', [UserController::class, 'create'])->name('user.create');
        Route::post('/manajemen-user', [UserController::class, 'store'])->name('user.store');
        Route::delete('/manajemen-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        // Halaman Laporan
        Route::get('/laporan', [LaporanController::class,'index'])->name('laporan.index');
        Route::get('/laporan/nilai/pegawai/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/nilai/pegawai/export/pdf/{id}', [LaporanController::class, 'exportPdfEmployee'])->name('laporan.pdf.employee');
        Route::put('/laporan/nilai/pegawai/{id}', [LaporanController::class, 'update'])->name('laporan.update');
    }); 
    
    Route::middleware(['isAdmin:pegawai'])->prefix('pegawai')->group(function () {
        Route::get('/kegiatan', [KegiatanPegawaiController::class, 'index'])->name('pegawai.kegiatan.index');
        Route::put('/kegiatan/upload/{id}', [KegiatanPegawaiController::class, 'uploadFile'])->name('pegawai.kegiatan.uploadFile');
        Route::get('/laporan', 'Pegawai\LaporanKegiatanPegawaiController')->name('pegawai.kegiatan.laporan');
        Route::get('/pegawai/kegiatan/upload', [KegiatanPegawaiController::class, 'create'])->name('pegawai.kegiatan.create');
        Route::post('/pegawai/kegiatan/upload', [KegiatanPegawaiController::class, 'store'])->name('pegawai.kegiatan.store');
    });

    Route::middleware(['isAdmin:penilai'])->group(function () {
        // Halaman Pegawai
        Route::get('/nilai/pegawai', [NilaiPegawaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/tambah-nilai', [NilaiPegawaiController::class, 'create'])->name('nilai.create');
        Route::get('/nilai/pegawai/export/pdf', [NilaiPegawaiController::class, 'exportPdf'])->name('nilai.pdf');
        Route::get('/nilai/pegawai/export/pdf/{id}', [NilaiPegawaiController::class, 'exportPdfEmployee'])->name('nilai.pdf.employee');
        Route::put('/nilai/pegawai/{id}', [NilaiPegawaiController::class, 'update'])->name('nilai.update');

        //Halaman Kegiatan
         Route::get('/nilai/kegiatan', [KegiatanPenilaiController::class, 'index'])->name('penilai.kegiatan.index');
         Route::put('/nilai/kegiatan/{id}', [KegiatanPenilaiController::class, 'update'])->name('penilai.kegiatan.update');
         Route::get('/nilai/kegiatan/tambah-kegiatan', [KegiatanPenilaiController::class, 'create'])->name('penilai.kegiatan.create');

    });
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
]);
