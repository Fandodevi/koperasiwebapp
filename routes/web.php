<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\UserController;
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

Route::middleware('only_sign_in')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'destroy'])->name('logout');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('admin/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
        Route::get('admin/pegawai/add', [PegawaiController::class, 'create'])->name('pegawai.create');
        Route::post('admin/pegawai/add', [PegawaiController::class, 'store'])->name('pegawai.store');
        Route::get('admin/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
        Route::put('admin/pegawai/edit/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
        Route::get('admin/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

        Route::get('admin/anggota', [AnggotaController::class, 'index'])->name('anggota');
        Route::get('admin/anggota/add', [AnggotaController::class, 'create'])->name('anggota.create');
        Route::post('admin/anggota/add', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::get('admin/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
        Route::put('admin/anggota/edit/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
        Route::get('admin/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

        Route::get('admin/simpanan', [SimpananController::class, 'index'])->name('simpanan');
        Route::get('admin/simpanan/add', [SimpananController::class, 'create'])->name('simpanan.create');
        Route::post('admin/simpanan/add', [SimpananController::class, 'store'])->name('simpanan.store');
        Route::get('admin/simpanan/view/{id}', [SimpananController::class, 'show'])->name('simpanan.show');
        Route::get('admin/simpanan/edit/{id}', [SimpananController::class, 'edit'])->name('simpanan.edit');
        Route::put('admin/simpanan/edit/{id}', [SimpananController::class, 'update'])->name('simpanan.update');
        Route::get('admin/simpanan/{id}', [SimpananController::class, 'destroy'])->name('simpanan.destroy');

        Route::get('admin/pinjaman', [PinjamanController::class, 'index'])->name('pinjaman');
        Route::get('admin/pinjaman/add', [PinjamanController::class, 'create'])->name('pinjaman.create');
        Route::post('admin/pinjaman/add', [PinjamanController::class, 'store'])->name('pinjaman.store');
        Route::get('admin/pinjaman/view/{id}', [PinjamanController::class, 'show'])->name('pinjaman.show');
        Route::get('admin/pinjaman/edit/{id}', [PinjamanController::class, 'edit'])->name('pinjaman.edit');
        Route::put('admin/pinjaman/edit/{id}', [PinjamanController::class, 'update'])->name('pinjaman.update');
        Route::get('admin/pinjaman/{id}', [PinjamanController::class, 'destroy'])->name('pinjaman.destroy');

        Route::get('admin/laporan', [LaporanController::class, 'index'])->name('laporan');
    });

    Route::group(['middleware' => 'pegawai'], function () {
    });
    // Route::get('/pagesimpanan', [SimpananController::class, 'page'])->name('simpanantabel');
    // Route::get('/simpanan', [SimpananController::class, 'index'])->name('simpanantabel');
});


//admin
Route::group(['middleware' => 'auth'], function () {

    Route::get('/delete/{id}', [AnggotaController::class, 'delete'])->name('deletedata');

    Route::get('/pageuser', [UserController::class, 'page'])->name('PageUser');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('deletedata');
});