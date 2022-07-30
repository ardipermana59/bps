<?php

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
Route::get('/', function () {
    return view('welcome');
});
Route::view('/', 'pages.dashboard')->name('dashboard');
Route::view('/pegawai', 'pages.employee.index')->name('employee.index');
Route::view('/penilai', 'pages.penilai.index')->name('penilai.index');
Route::view('/jabatan', 'pages.position.index')->name('position.index');
Route::view('/kegiatan', 'pages.activity.index')->name('activity.index');
Route::view('/jabatan', 'pages.job.index')->name('job.index');
Route::view('/kriteria', 'pages.criteria.index')->name('criteria.index');
Route::view('/struktur-penilai', 'pages.struktur.index')->name('struktur.index');
Route::get('/manajemen-user', [UserController::class, 'index'])->name('user.index');
Route::delete('/manajemen-user', [UserController::class, 'destroy'])->name('user.destroy');
Route::view('/laporan', 'pages.laporan.index')->name('laporan.index');

Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
]);

// Route::get('/home', 'HomeController@index')->name('home');
