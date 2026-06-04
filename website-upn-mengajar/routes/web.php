<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminController;

// ======= HALAMAN PUBLIK =======
Route::get('/', fn() => redirect('/beranda'));
Route::get('/beranda', fn() => view('beranda'))->name('beranda');
Route::get('/tentang', fn() => view('tentang'))->name('tentang');
Route::get('/kegiatan', fn() => view('kegiatan'))->name('kegiatan');
Route::get('/upnmengajar', fn() => view('upnmengajar'))->name('upnmengajar');
Route::get('/ukm', fn() => view('ukm'))->name('ukm');
Route::get('/tim', fn() => view('tim'))->name('tim');
Route::get('/kontak', fn() => view('kontak'))->name('kontak');

// ======= AUTH =======
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ======= RELAWAN (publik tapi butuh login untuk daftar) =======
Route::get('/relawan', [RelawanController::class, 'index'])->name('relawan');
Route::get('/relawan/sd', [RelawanController::class, 'sd'])->name('relawan.sd');
Route::get('/relawan/slb', [RelawanController::class, 'slb'])->name('relawan.slb');
Route::get('/relawan/yayasan', [RelawanController::class, 'yayasan'])->name('relawan.yayasan');

// ======= PENDAFTARAN (harus login) =======
Route::middleware('auth.user')->group(function () {
    Route::get('/formulir', [PendaftaranController::class, 'form'])->name('formulir');
    Route::post('/formulir', [PendaftaranController::class, 'store']);
    Route::get('/status-pendaftaran', [PendaftaranController::class, 'status'])->name('status.pendaftaran');
});

// ======= ADMIN (harus login sebagai admin) =======
Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/relawan', [AdminController::class, 'relawan'])->name('admin.relawan');
    Route::delete('/relawan/{id}', [AdminController::class, 'hapusRelawan'])->name('admin.relawan.hapus');
    Route::get('/kegiatan', [AdminController::class, 'kegiatan'])->name('admin.kegiatan');
    Route::get('/kegiatan/tambah', [AdminController::class, 'tambahKegiatan'])->name('admin.kegiatan.tambah');
    Route::post('/kegiatan/tambah', [AdminController::class, 'simpanKegiatan']);
    Route::get('/kegiatan/edit/{id}', [AdminController::class, 'editKegiatan'])->name('admin.kegiatan.edit');
    Route::post('/kegiatan/edit/{id}', [AdminController::class, 'updateKegiatan']);
    Route::delete('/kegiatan/{id}', [AdminController::class, 'hapusKegiatan'])->name('admin.kegiatan.hapus');
    Route::get('/export-excel', [AdminController::class, 'exportExcel'])->name('admin.export');
});