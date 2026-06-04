<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RelawanController;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK / PENGUNJUNG UMUM
|--------------------------------------------------------------------------
*/

// Jalur Akses Halaman Utama / Beranda
Route::get('/', function () {
    return view('beranda');
})->name('home');

// Jalur Akses Tampilan Halaman Tentang Kami publik
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// Jalur Akses Dropdown "Tentang" Lainnya
Route::prefix('tentang')->group(function () {
    // Ubah ->name('ukm') menjadi ->name('tentang.ukm') agar seragam
    Route::get('/ukm', function () { 
        return view('ukm'); 
    })->name('tentang.ukm');

    Route::get('/upn-mengajar', function () { 
        return view('upnmengajar'); 
    })->name('tentang.upnmengajar');

    Route::get('/struktur', function () { 
        return view('tim'); 
    })->name('tentang.struktur');
});

// Jalur Akses Halaman Kegiatan
Route::get('/kegiatan', function () {
    return view('kegiatan');
})->name('kegiatan');


// Jalur akses menampilkan halaman kontak publik
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Jalur aksi penanganan kirim form pesan kontak
Route::post('/kontak/kirim', function (Request $request) {
    $request->validate([
        'nama' => 'required|string',
        'email' => 'required|email',
        'pesan' => 'required',
    ]);

    // Bisa dimasukkan logika DB::table('pesan_masuk')->insert(...) jika ingin disimpan ke database nanti
    return redirect()->route('kontak')->with('sukses', 'Terima kasih, pesan Anda telah berhasil dikirim!');
})->name('kontak.kirim');


/*
|--------------------------------------------------------------------------
| Bagian Relawan (Menu Utama & Detail Deskripsi Program)
|--------------------------------------------------------------------------
*/
// Halaman utama list program relawan
Route::get('/relawan', [RelawanController::class, 'index'])->name('relawan.index');

// Halaman formulir pendaftaran relawan masing-masing kategori
Route::get('/relawan-sd', [RelawanController::class, 'relawanSd'])->name('relawan.sd');
Route::get('/relawan-slb', [RelawanController::class, 'relawanSlb'])->name('relawan.slb');
Route::get('/relawan-yayasan', [RelawanController::class, 'relawanYayasan'])->name('relawan.yayasan');


/*
|--------------------------------------------------------------------------
| 2. RUTE UTENTIKASI (LOGIN / REGISTER / LOGOUT)
|--------------------------------------------------------------------------
*/

// Jalur Akses Tampilan Halaman Login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');

// Jalur Pemrosesan Data Form Login POST
Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');

// Jalur Akses Tampilan Halaman Pendaftaran (Register)
Route::get('/register', [LoginController::class, 'showRegister'])->name('register');

// Jalur Pemrosesan Form POST Kirim Data Registrasi
Route::post('/register', [LoginController::class, 'prosesRegister'])->name('register.proses');

// Route Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


/*
|--------------------------------------------------------------------------
| 3. RUTE KELOLA PENDAFTARAN RELAWAN (MIDDLEWARE AUTH)
|--------------------------------------------------------------------------
| Pengguna harus login terlebih dahulu agar sistem bisa mendata pendaftar & status seleksi secara aman
*/
Route::middleware(['auth'])->group(function () {
    // Jalur aksi pemrosesan penyimpanan data formulir dari blade pendaftaran relawan
    Route::post('/pendaftaran/simpan', [RelawanController::class, 'simpanPendaftaran'])->name('pendaftaran.simpan');

    // Jalur akses melihat status kelolosan seleksi pendaftaran relawan terakhir pengguna
    Route::get('/status-pendaftaran', [RelawanController::class, 'statusPendaftaran'])->name('pendaftaran.status');
});


/*
|--------------------------------------------------------------------------
| 4. GROUP ROUTE ADMIN (DIPROTEKSI MIDDLEWARE AUTH)
|--------------------------------------------------------------------------
| Semua rute di dalam grup ini otomatis diawali dengan URL '/admin' (contoh: /admin/dashboard)
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // 1. Halaman Utama Dashboard Admin & Logika Aksinya
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/kegiatan/arsip/{id}', [AdminDashboardController::class, 'arsipKegiatan'])->name('admin.kegiatan.arsip');
    Route::post('/relawan/terima/{id}', [AdminDashboardController::class, 'terimaRelawan'])->name('admin.relawan.terima');
    Route::delete('/dashboard/hapus/{id}', [AdminDashboardController::class, 'hapusKegiatan'])->name('admin.kegiatan.hapus_dashboard');

    // --- Operasional Kelola Kegiatan (Create) ---
    Route::get('/kegiatan/tambah', [AdminDashboardController::class, 'tambahKegiatan'])->name('admin.kegiatan.tambah');
    Route::post('/kegiatan/simpan', [AdminDashboardController::class, 'simpanKegiatan'])->name('admin.kegiatan.simpan');

    // 2. Halaman Khusus Kelola Kegiatan & Logika Hapus Data Kegiatan
    Route::get('/kegiatan', [AdminDashboardController::class, 'kegiatan'])->name('admin.kegiatan');
    Route::delete('/kegiatan/{id}', [AdminDashboardController::class, 'hapusKegiatan'])->name('admin.kegiatan.hapus');

    // 3. Fitur Manajemen Data Relawan (Pencarian, Filter, dan Hapus)
    Route::get('/relawan', [AdminDashboardController::class, 'relawan'])->name('admin.relawan');
    Route::delete('/relawan/{id}', [AdminDashboardController::class, 'hapusRelawan'])->name('admin.relawan.hapus');

    // 4. Fitur Kelola Kegiatan (Form Edit & Proses Update / U and D)
    Route::get('/kegiatan/edit/{id}', [AdminDashboardController::class, 'editKegiatan'])->name('admin.kegiatan.edit');
    Route::put('/kegiatan/update/{id}', [AdminDashboardController::class, 'updateKegiatan'])->name('admin.kegiatan.update');

    // 5. Fitur Penunjang / Placeholder Ekstra Relawan
    Route::get('/relawan/export', function() { 
        return "Proses Ekspor Excel (Hubungkan ke Excel Package nanti)"; 
    })->name('admin.relawan.export');

    Route::get('/relawan/detail/{id}', function($id) { 
        return "Halaman Detail Calon Relawan ID: " . $id; 
    })->name('admin.relawan.detail');
    
});