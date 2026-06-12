<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanController; 
use App\Http\Controllers\KegiatanPublikController;
use App\Http\Controllers\UkmController; 

// ==================== ROUTE PUBLIK ====================

Route::get('/', [KegiatanController::class, 'beranda'])->name('beranda');
Route::get('/beranda', [KegiatanController::class, 'beranda']);

Route::get('/ukm', [UkmController::class, 'index']);

Route::get('/tentang', function () {
    return view('layouts.tentang');
});

Route::get('/upnmengajar', function () {
    return view('layouts.upnmengajar');
}); 

Route::get('/tim', function () { 
    return view('layouts.tim'); 
});

Route::get('/kegiatan', [KegiatanPublikController::class, 'index']);
Route::get('/kegiatan/detail/{id}', [KegiatanPublikController::class, 'detail'])->name('kegiatan.detail');
Route::get('/relawan', [KegiatanController::class, 'dokumentasi']); 

// Mengamankan formulir menggunakan pengecekan session manual publik
Route::get('/formulir', function () { 
    if (!session('id_user')) { 
        return redirect('/login')->withErrors(['login_error' => 'Silakan login terlebih dahulu!']); 
    }
    return view('publik.formulir'); 
});

// Rute untuk menampilkan halaman formulir mitra
Route::get('/formulir-mitra', function () {
    return view('publik.formulir_mitra');
});

// Rute untuk memproses data yang dikirim dari formulir mitra
Route::post('/formulir-mitra', function (Request $request) {
    $request->validate([
        'nama_instansi'         => 'required|string|max:255',
        'nama_penanggung_jawab' => 'required|string|max:255',
        'email_instansi'        => 'required|email|max:255',
        'no_hp'                 => 'required|string|max:20',
        'jenis_kemitraan'       => 'required|string',
        'pesan_kolaborasi'      => 'nullable|string',
    ]);

    DB::table('mitra')->insert([
        'nama_instansi'         => $request->nama_instansi,
        'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
        'email_instansi'        => $request->email_instansi,
        'no_hp'                 => $request->no_hp,
        'jenis_kemitraan'       => $request->jenis_kemitraan,
        'pesan_kolaborasi'      => $request->pesan_kolaborasi,
        'status_mitra'          => 'PENDING', 
        'created_at'            => now(),
        'updated_at'            => now()
    ]);

    return redirect()->back()->with('sukses', 'Formulir kemitraan berhasil dikirim! Data Anda telah masuk ke sistem dan sedang menunggu persetujuan Admin.');
});


// ==================== ROUTE AUTH (LOGIN, REGISTER, LOGOUT) ====================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');


// ==================== ROUTE ADMIN (MIDDLEWARE AUTH & PREFIX) ====================

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        
        // Dashboard Utama Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard_admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard_admin'); 
        
        // 1. Kelola Kegiatan (Tampil Data)
        Route::get('/kelola-kegiatan', function () {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            $kegiatan = DB::table('kegiatan')->get(); 
            return view('admin.kelola_kegiatan', compact('kegiatan'));
        });

        // 2. Detail Lengkap Kegiatan berdasarkan ID
        Route::get('/kelola-kegiatan/{id}', function ($id) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
            if (!$kegiatan) {
                return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!');
            }
            return view('admin.detail_kegiatan', compact('kegiatan'));
        });

        // 3. Kelola Kegiatan (Proses Hapus via Kelola Kegiatan)
        Route::delete('/kelola-kegiatan/{id}', function ($id) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
            return redirect('/admin/kelola-kegiatan')->with('pesan', 'Kegiatan berhasil dihapus!');
        })->name('admin.kegiatan.destroy');

        // 4. Form Edit Kegiatan (GET)
        Route::get('/edit-kegiatan/{id}', function ($id) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
            if (!$kegiatan) {
                return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!');
            }
            return view('admin.edit_kegiatan', compact('kegiatan'));
        });

        // 5. Proses Update Data Kegiatan (PUT)
        Route::put('/edit-kegiatan/{id}', function (Request $request, $id) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
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

        // 6. Kelola Relawan (Tampil Data + Search & Filter)
        Route::get('/kelola-relawan', function (Request $request) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
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
        })->name('admin.relawan.index');

        // Kompatibilitas URL /data-relawan agar tidak putus di sidebar lama
        Route::get('/data-relawan', function (Request $request) {
            return redirect()->route('admin.relawan.index');
        });

        // Mencegah RouteNotFoundException untuk tombol Cetak PDF
        Route::get('/kelola-relawan/pdf', function () {
            return "Fungsi unduh PDF sedang dikembangkan.";
        })->name('admin.relawan.pdf');

        // Mendaftarkan rute 'admin.relawan.ekspor' agar fitur Ekspor Excel tidak eror lagi
        Route::get('/kelola-relawan/ekspor', function () {
            return "Fungsi Ekspor Excel sedang dikembangkan.";
        })->name('admin.relawan.ekspor');

        // 7. Kelola Relawan (Proses Hapus Berdasarkan ID Pendaftaran)
        Route::delete('/kelola-relawan/{id_pendaftaran}', function ($id_pendaftaran) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            DB::table('pendaftaran_relawan')->where('id_pendaftaran', $id_pendaftaran)->delete();
            return redirect('/admin/kelola-relawan')->with('pesan', 'Data pendaftaran relawan berhasil dihapus!');
        })->name('admin.relawan.destroy');

        // 8. Detail Relawan
        Route::get('/detail-relawan/{id_pendaftaran}', function ($id_pendaftaran) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            $relawan = DB::table('pendaftaran_relawan as p')
                        ->join('users as u', 'p.id_user', '=', 'u.id_user')
                        ->join('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
                        ->select('p.*', 'u.nama_lengkap', 'u.email', 'k.id_kegiatan', 'k.nama_kegiatan', 'k.lokasi', 'k.tanggal_pelaksanaan', 'k.kategori')
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
        })->name('admin.relawan.detail');

        // 9. Proses Mengubah Status Seleksi Relawan
        Route::post('/detail-relawan/{id_pendaftaran}/update-status', function (Request $request, $id_pendaftaran) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
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
        })->name('admin.relawan.update_status');

        // 10. Kelola Relawan (Proses Impor Data dari CSV)
        Route::post('/impor-relawan', function (Request $request) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            $request->validate(['file_csv' => 'required|mimes:csv,txt']);
            $file = $request->file('file_csv');
            
            if (($handle = fopen($file->getRealPath(), 'r')) !== FALSE) {
                fgetcsv($handle, 1000, ','); 

                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    $nama          = $data[0];
                    $email         = $data[1];
                    $no_hp         = $data[2];
                    $umur          = $data[3];
                    $jk            = $data[4];
                    $prodi         = $data[5];
                    $nama_kegiatan = $data[6]; 
                    $divisi_1      = $data[7];
                    $divisi_2      = $data[8] ?? null;
                    $alasan        = $data[9] ?? null;

                    $kegiatan = DB::table('kegiatan')->where('nama_kegiatan', 'LIKE', "%{$nama_kegiatan}%")->first();
                    $id_kegiatan = $kegiatan ? $kegiatan->id_kegiatan : 1; 

                    DB::table('users')->updateOrInsert(
                        ['email' => $email],
                        ['nama_lengkap' => $nama, 'role' => 'relawan', 'password' => bcrypt('12345678')]
                    );

                    $user = DB::table('users')->where('email', $email)->first();

                    DB::table('pendaftaran_relawan')->insert([
                        'id_user'          => $user->id_user,
                        'id_kegiatan'      => $id_kegiatan, 
                        'no_hp'            => $no_hp,
                        'umur'             => $umur,
                        'jenis_kelamin'    => $jk,
                        'asal_prodi'       => $prodi,
                        'pilihan_divisi_1' => $divisi_1,
                        'pilihan_divisi_2' => $divisi_2,
                        'alasan_bergabung' => $alasan,
                        'status_seleksi'   => 'PENDING'
                    ]);
                }
                fclose($handle);
            }
            return redirect('/admin/kelola-relawan')->with('pesan', 'Seluruh data pendaftaran relawan dari CSV berhasil di-impor!');
        })->name('admin.relawan.impor');

        // ==================== TAMBAHAN: KELOLA DOKUMENTASI ====================
        
        // A. Tampil Halaman Utama Kelola Dokumentasi
        Route::get('/kelola-dokumentasi', function () {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            $dokumentasi = DB::table('dokumentasi')->orderBy('id_dokumentasi', 'DESC')->get(); 
            return view('admin.kelola_dokumentasi', compact('dokumentasi'));
        })->name('admin.dokumentasi');

        // B. Form Unggah / Tambah Dokumentasi Baru
        Route::get('/tambah-dokumentasi', function () {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            return view('admin.tambah_dokumentasi');
        })->name('admin.dokumentasi.tambah');

        // C. Proses Simpan Berkas Dokumentasi Ke Database
        Route::post('/tambah-dokumentasi', function (Request $request) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            
            $request->validate([
                'judul'     => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'foto'      => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $pathFoto = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $namaFoto = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/dokumentasi', $namaFoto);
                $pathFoto = 'dokumentasi/' . $namaFoto;
            }

            DB::table('dokumentasi')->insert([
                'judul'      => $request->judul,
                'deskripsi'  => $request->deskripsi,
                'foto'       => $pathFoto,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect('/admin/kelola-dokumentasi')->with('pesan', 'Berkas dokumentasi baru berhasil diunggah!');
        })->name('admin.dokumentasi.store');

        // ==================== TAMBAHAN: KELOLA MITRA ====================

        // 1. Tampil Halaman Kelola Mitra (Daftar Pengajuan Mitra)
        Route::get('/kelola-mitra', function (Request $request) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            
            $search = $request->input('search');
            $status = $request->input('status');

            $query = DB::table('mitra');

            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('nama_instansi', 'LIKE', "%{$search}%")
                      ->orWhere('nama_penanggung_jawab', 'LIKE', "%{$search}%");
                });
            }

            if (!empty($status) && $status !== 'semua') {
                $query->where('status_mitra', $status);
            }

            $mitra = $query->orderBy('id_mitra', 'DESC')->get();
            return view('admin.kelola_mitra', compact('mitra'));
        })->name('admin.mitra.index');

        // 2. Proses Mengubah Status Mitra (Disetujui / Ditolak)
        Route::post('/kelola-mitra/{id}/update-status', function (Request $request, $id) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            
            $request->validate([
                'status_mitra' => 'required|in:PENDING,DISETUJUI,DITOLAK'
            ]);

            DB::table('mitra')
                ->where('id_mitra', $id)
                ->update([
                    'status_mitra' => $request->status_mitra,
                    'updated_at' => now()
                ]);

            return redirect()->back()->with('pesan', 'Status kemitraan berhasil diperbarui menjadi ' . $request->status_mitra . '!');
        })->name('admin.mitra.update_status');

        // 3. Proses Hapus Data Pengajuan Mitra
        Route::delete('/kelola-mitra/{id}', function ($id) {
            if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
            DB::table('mitra')->where('id_mitra', $id)->delete();
            return redirect('/admin/kelola-mitra')->with('pesan', 'Data pengajuan kemitraan berhasil dihapus!');
        })->name('admin.mitra.destroy');

    });
});