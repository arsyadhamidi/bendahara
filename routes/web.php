<?php

use App\Http\Controllers\Admin\AdminBendaharaController;
use App\Http\Controllers\Admin\AdminIuranController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminPemasukanController;
use App\Http\Controllers\Admin\AdminPengeluaranController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminWargaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Warga\WargaIuranController;
use App\Http\Middleware\CekLevel;
use Illuminate\Support\Facades\Route;

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

// Landing
Route::get('/', [LandingController::class, 'index']);

//  Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login-action', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/login-logout', [LoginController::class, 'logout'])->name('login.logout');

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/updateprofile', [SettingController::class, 'updateprofile'])->name('setting.updateprofile');
    Route::post('/setting/updateusername', [SettingController::class, 'updateusername'])->name('setting.updateusername');
    Route::post('/setting/updatepassword', [SettingController::class, 'updatepassword'])->name('setting.updatepassword');
    Route::post('/setting/updategambar', [SettingController::class, 'updategambar'])->name('setting.updategambar');
    Route::post('/setting/hapusgambar', [SettingController::class, 'hapusgambar'])->name('setting.hapusgambar');

    // Admin
    Route::group(['middleware' => [CekLevel::class . ':1,2']], function () {

        // Data Pengeluaran
        Route::get('/data-pengeluaran', [AdminPengeluaranController::class, 'index'])->name('data-pengeluaran.index');
        Route::get('/data-pengeluaran/create', [AdminPengeluaranController::class, 'create'])->name('data-pengeluaran.create');
        Route::get('/data-pengeluaran/edit/{id}', [AdminPengeluaranController::class, 'edit'])->name('data-pengeluaran.edit');
        Route::post('/data-pengeluaran/store', [AdminPengeluaranController::class, 'store'])->name('data-pengeluaran.store');
        Route::post('/data-pengeluaran/update/{id}', [AdminPengeluaranController::class, 'update'])->name('data-pengeluaran.update');
        Route::post('/data-pengeluaran/destroy/{id}', [AdminPengeluaranController::class, 'destroy'])->name('data-pengeluaran.destroy');

        // Data Pemasukan
        Route::get('/data-pemasukan', [AdminPemasukanController::class, 'index'])->name('data-pemasukan.index');
        Route::get('/data-pemasukan/create', [AdminPemasukanController::class, 'create'])->name('data-pemasukan.create');
        Route::get('/data-pemasukan/edit/{id}', [AdminPemasukanController::class, 'edit'])->name('data-pemasukan.edit');
        Route::post('/data-pemasukan/store', [AdminPemasukanController::class, 'store'])->name('data-pemasukan.store');
        Route::post('/data-pemasukan/update/{id}', [AdminPemasukanController::class, 'update'])->name('data-pemasukan.update');
        Route::post('/data-pemasukan/destroy/{id}', [AdminPemasukanController::class, 'destroy'])->name('data-pemasukan.destroy');

        // Data Iuran
        Route::get('/data-iuran', [AdminIuranController::class, 'index'])->name('data-iuran.index');
        Route::get('/data-iuran/create', [AdminIuranController::class, 'create'])->name('data-iuran.create');
        Route::get('/data-iuran/edit/{id}', [AdminIuranController::class, 'edit'])->name('data-iuran.edit');
        Route::post('/data-iuran/store', [AdminIuranController::class, 'store'])->name('data-iuran.store');
        Route::post('/data-iuran/update/{id}', [AdminIuranController::class, 'update'])->name('data-iuran.update');
        Route::post('/data-iuran/destroy/{id}', [AdminIuranController::class, 'destroy'])->name('data-iuran.destroy');

        // Data Bendahara
        Route::get('/data-bendahara', [AdminBendaharaController::class, 'index'])->name('data-bendahara.index');
        Route::get('/data-bendahara/create', [AdminBendaharaController::class, 'create'])->name('data-bendahara.create');
        Route::get('/data-bendahara/edit/{id}', [AdminBendaharaController::class, 'edit'])->name('data-bendahara.edit');
        Route::post('/data-bendahara/store', [AdminBendaharaController::class, 'store'])->name('data-bendahara.store');
        Route::post('/data-bendahara/update/{id}', [AdminBendaharaController::class, 'update'])->name('data-bendahara.update');
        Route::post('/data-bendahara/destroy/{id}', [AdminBendaharaController::class, 'destroy'])->name('data-bendahara.destroy');

        // Data Warga
        Route::get('/data-warga', [AdminWargaController::class, 'index'])->name('data-warga.index');
        Route::get('/data-warga/create', [AdminWargaController::class, 'create'])->name('data-warga.create');
        Route::get('/data-warga/edit/{id}', [AdminWargaController::class, 'edit'])->name('data-warga.edit');
        Route::post('/data-warga/store', [AdminWargaController::class, 'store'])->name('data-warga.store');
        Route::post('/data-warga/update/{id}', [AdminWargaController::class, 'update'])->name('data-warga.update');
        Route::post('/data-warga/destroy/{id}', [AdminWargaController::class, 'destroy'])->name('data-warga.destroy');

        // Data User
        Route::get('/data-user', [AdminUserController::class, 'index'])->name('data-user.index');
        Route::get('/data-user/create', [AdminUserController::class, 'create'])->name('data-user.create');
        Route::get('/data-user/edit/{id}', [AdminUserController::class, 'edit'])->name('data-user.edit');
        Route::post('/data-user/store', [AdminUserController::class, 'store'])->name('data-user.store');
        Route::post('/data-user/update/{id}', [AdminUserController::class, 'update'])->name('data-user.update');
        Route::post('/data-user/destroy/{id}', [AdminUserController::class, 'destroy'])->name('data-user.destroy');

        // Level
        Route::get('/data-level', [AdminLevelController::class, 'index'])->name('data-level.index');
        Route::get('/data-level/create', [AdminLevelController::class, 'create'])->name('data-level.create');
        Route::get('/data-level/edit/{id}', [AdminLevelController::class, 'edit'])->name('data-level.edit');
        Route::post('/data-level/store', [AdminLevelController::class, 'store'])->name('data-level.store');
        Route::post('/data-level/update/{id}', [AdminLevelController::class, 'update'])->name('data-level.update');
        Route::post('/data-level/destroy/{id}', [AdminLevelController::class, 'destroy'])->name('data-level.destroy');
    });

    // Warga
    Route::group(['middleware' => [CekLevel::class . ':3']], function () {
        Route::get('/warga-iuran', [WargaIuranController::class, 'index'])->name('warga-iuran.index');
    });
});
