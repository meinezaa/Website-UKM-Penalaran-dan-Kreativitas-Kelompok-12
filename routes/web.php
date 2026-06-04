<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;

// Route Login (Bisa diakses siapa saja yang belum login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// --- TONGGAK PENGAMAN (MIDDLEWARE) ---
// Semua route di dalam grup ini WAJIB login dulu. Kalau belum login, otomatis ditendang balik ke halaman login.
Route::middleware(['auth'])->group(function () {
    
    // Route Dashboard Admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/kegiatan/{id}', [AdminDashboardController::class, 'destroyKegiatan'])->name('admin.kegiatan.destroy');
    
    // Nanti kalau ada halaman beranda user biasa yang harus login dulu, tinggal taruh di sini:
    // Route::get('/beranda', [UserController::class, 'beranda']);
});

// Route Tampilan Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Route Proses Aksi Form Login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// Route Tampilan Halaman Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Route Proses Aksi Form Register (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');

// Route untuk menampilkan halaman utama dashboard admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Route untuk memproses aksi hapus kegiatan
Route::delete('/admin/kegiatan/{id}', [AdminDashboardController::class, 'destroyKegiatan'])->name('admin.kegiatan.destroy');
