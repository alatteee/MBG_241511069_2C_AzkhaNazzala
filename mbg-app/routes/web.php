<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\PermintaanController;

Route::get('/', function () {
    return redirect()->route('login'); // langsung ke  halaman login kalau buka root
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/gudang', [AuthController::class, 'gudangDashboard'])->name('dashboard.gudang');
    Route::get('/dashboard/dapur', [AuthController::class, 'dapurDashboard'])->name('dashboard.dapur');

    Route::resource('bahan', BahanBakuController::class);
    Route::resource('permintaan', PermintaanController::class);
});

