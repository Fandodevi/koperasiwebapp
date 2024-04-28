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
        Route::get('admin/pegawai/export/pdf', [PegawaiController::class, 'export'])->name('pegawai.export');

        Route::get('admin/anggota', [AnggotaController::class, 'index'])->name('anggota');
        Route::get('admin/anggota/add', [AnggotaController::class, 'create'])->name('anggota.create');
        Route::post('admin/anggota/add', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::get('admin/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
        Route::put('admin/anggota/edit/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
        Route::get('admin/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
        Route::get('admin/anggota/export/pdf', [AnggotaController::class, 'export'])->name('anggota.export');

        Route::get('admin/simpanan', [SimpananController::class, 'index'])->name('simpanan');
        Route::get('admin/simpanan/add', [SimpananController::class, 'create'])->name('simpanan.create');
        Route::post('admin/simpanan/add', [SimpananController::class, 'store'])->name('simpanan.store');
        Route::get('admin/simpanan/view/{id}', [SimpananController::class, 'show'])->name('simpanan.show');
        Route::get('admin/simpanan/edit/{id}', [SimpananController::class, 'edit'])->name('simpanan.edit');
        Route::put('admin/simpanan/edit/{id}', [SimpananController::class, 'update'])->name('simpanan.update');
        Route::get('admin/simpanan/{id}', [SimpananController::class, 'destroy'])->name('simpanan.destroy');
        Route::get('admin/simpanan/view/delete/{id}', [SimpananController::class, 'destroyDetail'])->name('simpanan.destroy.detail');
        Route::get('admin/simpanan/export/pdf/{id}', [SimpananController::class, 'export'])->name('simpanan.export');

        Route::get('admin/pinjaman', [PinjamanController::class, 'index'])->name('pinjaman');
        Route::get('admin/pinjaman/add', [PinjamanController::class, 'create'])->name('pinjaman.create');
        Route::post('admin/pinjaman/add', [PinjamanController::class, 'store'])->name('pinjaman.store');
        Route::get('admin/pinjaman/view/{id}', [PinjamanController::class, 'show'])->name('pinjaman.show');
        Route::get('admin/pinjaman/edit/{id}', [PinjamanController::class, 'edit'])->name('pinjaman.edit');
        Route::put('admin/pinjaman/edit/{id}', [PinjamanController::class, 'update'])->name('pinjaman.update');
        Route::get('admin/pinjaman/{id}', [PinjamanController::class, 'destroy'])->name('pinjaman.destroy');
        Route::get('admin/pinjaman/export/pdf/{id}', [PinjamanController::class, 'export'])->name('pinjaman.export');

        Route::get('admin/laporan', [LaporanController::class, 'index'])->name('laporan');
    });

    Route::group(['middleware' => 'pegawai'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('pegawai.dashboard');

        Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.pegawai');
        Route::get('pegawai/add', [PegawaiController::class, 'create'])->name('pegawai.pegawai.create');
        Route::post('pegawai/add', [PegawaiController::class, 'store'])->name('pegawai.pegawai.store');
        Route::get('pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.pegawai.edit');
        Route::put('pegawai/edit/{id}', [PegawaiController::class, 'update'])->name('pegawai.pegawai.update');
        Route::get('pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.pegawai.destroy');

        Route::get('anggota', [AnggotaController::class, 'index'])->name('pegawai.anggota');
        Route::get('anggota/add', [AnggotaController::class, 'create'])->name('pegawai.anggota.create');
        Route::post('anggota/add', [AnggotaController::class, 'store'])->name('pegawai.anggota.store');
        Route::get('anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('pegawai.anggota.edit');
        Route::put('anggota/edit/{id}', [AnggotaController::class, 'update'])->name('pegawai.anggota.update');
        Route::get('anggota/{id}', [AnggotaController::class, 'destroy'])->name('pegawai.anggota.destroy');

        Route::get('simpanan', [SimpananController::class, 'index'])->name('pegawai.simpanan');
        Route::get('simpanan/add', [SimpananController::class, 'create'])->name('pegawai.simpanan.create');
        Route::post('simpanan/add', [SimpananController::class, 'store'])->name('spegawai.impanan.store');
        Route::get('simpanan/view/{id}', [SimpananController::class, 'show'])->name('pegawai.simpanan.show');
        Route::get('simpanan/edit/{id}', [SimpananController::class, 'edit'])->name('pegawai.simpanan.edit');
        Route::put('simpanan/edit/{id}', [SimpananController::class, 'update'])->name('pegawai.simpanan.update');
        Route::get('simpanan/{id}', [SimpananController::class, 'destroy'])->name('pegawai.simpanan.destroy');

        Route::get('pinjaman', [PinjamanController::class, 'index'])->name('pegawai.pinjaman');
        Route::get('pinjaman/add', [PinjamanController::class, 'create'])->name('pegawai.pinjaman.create');
        Route::post('pinjaman/add', [PinjamanController::class, 'store'])->name('pegawai.pinjaman.store');
        Route::get('pinjaman/view/{id}', [PinjamanController::class, 'show'])->name('pegawai.pinjaman.show');
        Route::get('pinjaman/edit/{id}', [PinjamanController::class, 'edit'])->name('pegawai.pinjaman.edit');
        Route::put('pinjaman/edit/{id}', [PinjamanController::class, 'update'])->name('pegawai.pinjaman.update');
        Route::get('pinjaman/{id}', [PinjamanController::class, 'destroy'])->name('pegawai.pinjaman.destroy');

        Route::get('laporan', [LaporanController::class, 'index'])->name('pegawai.laporan');
    });
});


//admin
Route::group(['middleware' => 'auth'], function () {

    Route::get('/delete/{id}', [AnggotaController::class, 'delete'])->name('deletedata');

    Route::get('/pageuser', [UserController::class, 'page'])->name('PageUser');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('deletedata');
});
