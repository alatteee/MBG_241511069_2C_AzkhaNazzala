<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\DashboardGudangController;

Route::get('/', function () {
    return redirect()->route('login'); // langsung ke  halaman login kalau buka root
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/gudang', [DashboardGudangController::class, 'index'])
    ->name('dashboard.gudang');
    Route::get('/dashboard/dapur', [App\Http\Controllers\DashboardDapurController::class, 'index'])
    ->name('dashboard.dapur');

    Route::resource('bahan', BahanBakuController::class);
    Route::resource('permintaan', PermintaanController::class);
    Route::get('/permintaan/create', [PermintaanController::class, 'create'])->name('permintaan.create');
    Route::post('/permintaan', [PermintaanController::class, 'store'])->name('permintaan.store');
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');

    // Admin Kelola Permintaan
    Route::get('/admin/permintaan', [PermintaanController::class, 'indexAdmin'])->name('admin.permintaan.index');
    Route::post('/admin/permintaan/{id}/approve', [PermintaanController::class, 'approve'])->name('admin.permintaan.approve');
    Route::post('/admin/permintaan/{id}/reject', [PermintaanController::class, 'reject'])->name('admin.permintaan.reject');

});

