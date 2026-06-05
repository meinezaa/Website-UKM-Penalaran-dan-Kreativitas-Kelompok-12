<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanPublikController;

// ==================== ROUTE PUBLIK ====================
Route::get('/', function () { return view('publik.beranda'); });
Route::get('/kegiatan', function () { return view('publik.kegiatan'); });
Route::get('/formulir', function () { return view('publik.formulir'); })->middleware('auth');

// ==================== ROUTE ADMIN ====================

// 1. Kelola Kegiatan (Tampil Data)
Route::get('/admin/kelola-kegiatan', function () {
    $kegiatan = DB::table('kegiatan')->get(); 
    return view('admin.kelola_kegiatan', compact('kegiatan'));
});

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;

// Route Login (Bisa diakses siapa saja yang belum login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');


// ==================== ROUTE ADMIN (PROTECTED VIA MIDDLEWARE) ====================

Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama Admin & Jalur Hapus Dashboard
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
// 2. Detail Lengkap Kegiatan berdasarkan ID
Route::get('/admin/kelola-kegiatan/{id}', function ($id) {
    $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
    
    if (!$kegiatan) {
        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!');
    }
    
    return view('admin.detail_kegiatan', compact('kegiatan'));
});

    // 3. Kelola Kegiatan (Proses Hapus via Kelola Kegiatan)
    Route::delete('/admin/kelola-kegiatan/{id}', function ($id) {
        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Kegiatan berhasil dihapus!');
    });

    // 4. Form Edit Kegiatan (GET)
    Route::get('/admin/edit-kegiatan/{id}', function ($id) {
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
        if (!$kegiatan) {
            return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!');
        }
        return view('admin.edit_kegiatan', compact('kegiatan'));

    });

    // 5. Proses Update Data Kegiatan (PUT)
    Route::put('/admin/edit-kegiatan/{id}', function (Request $request, $id) {
        $kegiatanLama = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
        $namaFoto = $kegiatanLama->foto_kegiatan;

        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kegiatan', $namaFoto);
            $namaFoto = 'kegiatan/' . $namaFoto;
        }

        DB::table('kegiatan')
            ->where('id_kegiatan', $id)
            ->update([
                'nama_kegiatan'       => $request->nama_kegiatan,
                'kategori'            => $request->kategori,
                'pendaftaran_dibuka'  => $request->pendaftaran_dibuka,
                'batas_registrasi'    => $request->batas_registrasi,
                'pengumuman_seleksi'  => $request->pengumuman_seleksi,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'divisi_dibutuhkan'   => $request->divisi_dibutuhkan,
                'lokasi'              => $request->lokasi,
                'jam_kegiatan'        => $request->jam_kegiatan,
                'alamat_lengkap'      => $request->alamat_lengkap,
                'deskripsi_detail'    => $request->deskripsi_detail,
                'detail_aktivitas'    => $request->detail_aktivitas,
                'status_kegiatan'     => $request->status_kegiatan,
                'foto_kegiatan'       => $namaFoto
            ]);

        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data agenda kegiatan sukses diperbarui!');
    });

    // 6. Kelola Relawan (Tampil Data Lengkap + Hubungan ke Kegiatan + Search & Filter)
    Route::get('/admin/kelola-relawan', function (Request $request) {
        $search = $request->input('search');
        $divisi = $request->input('divisi');

        $query = DB::table('pendaftaran_relawan as p')
                    ->join('users as u', 'p.id_user', '=', 'u.id_user')
                    ->join('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
                    ->select('p.*', 'u.nama_lengkap', 'u.email', 'k.nama_kegiatan');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('u.nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('p.asal_prodi', 'LIKE', "%{$search}%")
                  ->orWhere('k.nama_kegiatan', 'LIKE', "%{$search}%"); 
            });
        }

        if (!empty($divisi) && $divisi !== 'semua') {
            $query->where('p.pilihan_divisi_1', $divisi);
        }

        $relawan = $query->orderBy('p.id_pendaftaran', 'DESC')->get();
        return view('admin.kelola_relawan', compact('relawan'));
    });

    // 7. Kelola Relawan (Proses Hapus Berdasarkan ID Pendaftaran)
    Route::delete('/admin/kelola-relawan/{id_pendaftaran}', function ($id_pendaftaran) {
        DB::table('pendaftaran_relawan')->where('id_pendaftaran', $id_pendaftaran)->delete();
        return redirect('/admin/kelola-relawan')->with('pesan', 'Data partisipasi pendaftaran relawan berhasil dihapus!');
    });

    // 8. Detail Relawan
    Route::get('/admin/detail-relawan/{id_pendaftaran}', function ($id_pendaftaran) {
        $relawan = DB::table('pendaftaran_relawan as p')
                    ->join('users as u', 'p.id_user', '=', 'u.id_user')
                    ->join('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
                    ->select(
                        'p.*', 
                        'u.nama_lengkap', 
                        'u.email', 
                        'k.id_kegiatan',
                        'k.nama_kegiatan', 
                        'k.lokasi', 
                        'k.tanggal_pelaksanaan', 
                        'k.kategori'
                    )
                    ->where('p.id_pendaftaran', $id_pendaftaran)
                    ->first();

        if (!$relawan) {
            return redirect('/admin/kelola-relawan')->with('pesan', 'Data relawan tidak ditemukan!');
        }

        $relawan->kegiatan = (object) [
            'id_kegiatan' => $relawan->id_kegiatan,
            'nama_kegiatan' => $relawan->nama_kegiatan,
            'lokasi' => $relawan->lokasi,
            'tanggal_pelaksanaan' => $relawan->tanggal_pelaksanaan,
            'kategori' => $relawan->kategori,
        ];

        return view('admin.detail_relawan', compact('relawan'));
    });

    // 9. Proses Mengubah Status Seleksi Relawan
    Route::post('/admin/detail-relawan/{id_pendaftaran}/update-status', function (Request $request, $id_pendaftaran) {
        $request->validate([
            'status_seleksi' => 'required|in:Diterima,Ditolak,Pending,DITERIMA,DITOLAK,PENDING'
        ]);

        $statusUppercase = strtoupper($request->status_seleksi);

        DB::table('pendaftaran_relawan')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->update([
                'status_seleksi' => $statusUppercase,
                'updated_at' => now()
            ]);

        return redirect()->back()->with('pesan', 'Status seleksi relawan berhasil diperbarui menjadi ' . $statusUppercase . '!');
    });

    // 10. Kelola Relawan (Proses Impor Data dari CSV)
    Route::post('/admin/impor-relawan', function (Request $request) {
        $request->validate(['file_csv' => 'required|mimes:csv,txt']);
        $file = $request->file('file_csv');
        
        if (!$kegiatan) {
            return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!');
        }
        
        return view('admin.edit_kegiatan', compact('kegiatan'));
    });

    // 11. Proses Update Data Kegiatan (PUT)
    Route::put('/admin/edit-kegiatan/{id}', function (Request $request, $id) {
        $kegiatanLama = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
        $namaFoto = $kegiatanLama->foto_kegiatan;

        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kegiatan', $namaFoto);
            $namaFoto = 'kegiatan/' . $namaFoto;
        }

        DB::table('kegiatan')
            ->where('id_kegiatan', $id)
            ->update([
                'nama_kegiatan'       => $request->nama_kegiatan,
                'kategori'            => $request->kategori,
                'pendaftaran_dibuka'  => $request->pendaftaran_dibuka,
                'batas_registrasi'    => $request->batas_registrasi,
                'pengumuman_seleksi'  => $request->pengumuman_seleksi,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'divisi_dibutuhkan'   => $request->divisi_dibutuhkan,
                'lokasi'              => $request->lokasi,
                'jam_kegiatan'        => $request->jam_kegiatan,
                'alamat_lengkap'      => $request->alamat_lengkap,
                'deskripsi_detail'    => $request->deskripsi_detail,
                'detail_aktivitas'    => $request->detail_aktivitas,
                'status_kegiatan'     => $request->status_kegiatan,
                'foto_kegiatan'       => $namaFoto
            ]);

    return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data agenda kegiatan sukses diperbarui!');
});
>>>>>>>>> Temporary merge branch 2
