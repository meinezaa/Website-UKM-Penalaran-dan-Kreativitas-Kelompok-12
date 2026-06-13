<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\KegiatanPublikController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UkmController;

// ==================== ROUTE PUBLIK ====================

Route::get('/', function () { 
    // 1. Hitung jumlah relawan yang ada di database (tabel pendaftaran_relawan)
    $jumlahRelawan = DB::table('pendaftaran_relawan')->count();

    // 2. FIX AKURASI DATA: Menghitung mitra yang berstatus disetujui tanpa case-sensitive (DISETUJUI/Disetujui/disetujui)
    $jumlahSekolah = DB::table('mitra')->whereIn('status_mitra', ['DISETUJUI', 'Disetujui', 'disetujui'])->count();
    
    // 3. Kalkulasi jumlah siswa terlibat
    $jumlahSiswaTerlibat = DB::table('pendaftaran_relawan')->where('status_seleksi', 'DITERIMA')->count() * 30; 

    // 4. Kirimkan semua variabel tersebut ke dalam view beranda
    return view('publik.beranda', compact('jumlahRelawan', 'jumlahSekolah', 'jumlahSiswaTerlibat')); 
});

// Target folder view layouts publik
Route::get('/tentang', function () { 
    return view('layouts.tentang'); 
});

Route::get('/ukm', [UkmController::class, 'index'])->name('ukm');

Route::get('/upnmengajar', function () { 
    return view('layouts.upnmengajar'); 
});

Route::get('/tim', [UkmController::class, 'Tim']);

// Menampilkan halaman kegiatan publik beserta statusnya
Route::get('/kegiatan', function () {
    $kegiatanBuka = DB::table('kegiatan')->where('status_kegiatan', 'BUKA')->get();
    $kegiatanBerjalan = DB::table('kegiatan')->where('status_kegiatan', 'BERJALAN')->get();
    $kegiatanSelesai = DB::table('kegiatan')->where('status_kegiatan', 'SELESAI')->get();
    $kegiatanTutup = DB::table('kegiatan')->where('status_kegiatan', 'TUTUP')->get();

    return view('publik.kegiatan', compact('kegiatanBuka', 'kegiatanBerjalan', 'kegiatanSelesai', 'kegiatanTutup'));
});

Route::get('/kegiatan/{id}', [KegiatanController::class, 'detail'])->name('kegiatan.detail');

Route::get('/formulir', function () { 
    if (!session('id_user')) { 
        return redirect('/login')->withErrors(['login_error' => 'Silakan login terlebih dahulu!']); 
    }
    return view('publik.formulir'); 
});

// Rute untuk menampilkan halaman formulir pendaftaran mitra
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


// ==================== ROUTE AUTH (LOGIN & REGISTER) ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');


// ==================== ROUTE ADMIN (MENGGUNAKAN GRUP STANDARD SESSION KELOMPOK) ====================
Route::group([], function () {
    
    // Dashboard Utama Admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/kegiatan/{id}', [AdminDashboardController::class, 'destroyKegiatan'])->name('admin.kegiatan.destroy');
    
    // 1. Kelola Kegiatan (Tampil Data) - DIUBAH MENJADI /admin/kelola-kegiatan
    Route::get('/admin/kelola-kegiatan', function () {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        $kegiatan = DB::table('kegiatan')->get(); 
        return view('admin.kelola_kegiatan', compact('kegiatan'));
    })->name('admin.kegiatan.index');

    // [BARU] 1b. Form Tambah Kegiatan (GET)
    Route::get('/admin/tambah-kegiatan', function () {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        return view('admin.tambah_kegiatan'); // Pastikan kamu punya file resources/views/admin/tambah_kegiatan.blade.php
    })->name('admin.kegiatan.create');

    // [BARU] 1c. Proses Simpan Data Kegiatan Baru (POST)
    Route::post('/admin/tambah-kegiatan', function (Request $request) {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        
        // 1. Proses Upload Foto Poster Kegiatan ke Storage Laravel
        $namaFoto = 'default.jpg';
        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kegiatan', $namaFoto);
            $namaFoto = 'kegiatan/' . $namaFoto;
        }

        // 2. Jalankan Database Transaction murni Laravel
        DB::beginTransaction();

        try {
            // QUERY 1: Simpan Data ke tabel 'kegiatan'
            $idKegiatanBaru = DB::table('kegiatan')->insertGetId([
                'id_user'             => session('id_user'),
                'foto_kegiatan'       => $namaFoto,
                'nama_kegiatan'       => $request->nama_kegiatan,
                'kategori'            => $request->kategori,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'jam_kegiatan'        => $request->jam_kegiatan,
                'batas_registrasi'    => $request->batas_registrasi,
                'lokasi'              => $request->lokasi,
                'alamat_lengkap'      => $request->alamat_lengkap,
                'detail_aktivitas'    => $request->detail_aktivitas,
                'deskripsi_detail'    => $request->deskripsi_detail,
                
                // MENGGUNAKAN STRTOUPPER AGAR SINKRON DENGAN ENUM 'BUKA' DI DATABASE
                'status_kegiatan'     => strtoupper($request->status_kegiatan ?? 'BUKA')
            ]);

            // List divisi sesuai dengan input form native-mu
            $divisiList = [
                'sekretaris' => 'Sekretaris', 'bendahara' => 'Bendahara', 
                'acara' => 'Acara', 'humas' => 'Humas', 
                'perkap' => 'Perkap', 
                'pendamping' => 'Pendamping', // <--- Dipotong agar tidak kepanjangan di database
                'pdd' => 'PDD', 'sponsorship' => 'Sponsorship'
            ];

            // QUERY 2: Looping simpan kuota per divisi ke tabel 'divisi_kegiatan'
            foreach ($divisiList as $key => $label) {
                $kuotaInput = $request->input('kuota_' . $key);
                $kuota = !empty($kuotaInput) ? (int)$kuotaInput : 0;
                $jobdesc = $request->input('jobdesc_' . $key) ?? '';

                if ($kuota > 0) {
                    DB::table('divisi_kegiatan')->insert([
                        'id_kegiatan' => $idKegiatanBaru,
                        'nama_divisi' => $label,
                        'kuota'       => $kuota,
                        'jobdesc'     => $jobdesc,
                    ]);
                }
            }

            // Jika semua query berhasil tanpa error, komit ke database
            DB::commit();

            return redirect()->route('admin.kegiatan.index')->with('sukses', 'Kegiatan baru berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Jika ada satu saja yang gagal, batalkan semua (rollback)
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan kegiatan: ' . $e->getMessage());
        }
    })->name('admin.kegiatan.store');

    // 2. Detail Lengkap Kegiatan berdasarkan ID - DIUBAH JUGA AGAR SERAGAM
    Route::get('/admin/kelola-kegiatan/{id}', function ($id) {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
        if (!$kegiatan) {
            return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!');
        }
        return view('admin.detail_kegiatan', compact('kegiatan'));
    });

    // 3. Kelola Kegiatan (Proses Hapus via Kelola Kegiatan)
    Route::delete('/admin/kelola-kegiatan/{id}', function ($id) {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Kegiatan berhasil dihapus!');
    })->name('admin.kegiatan.internal_destroy');

    // 4. Form Edit Kegiatan (GET)
    Route::get('/admin/edit-kegiatan/{id}', function ($id) {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
        if (!$kegiatan) {
            return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!');
        }
        return view('admin.edit_kegiatan', compact('kegiatan'));
    });

    // 5. Proses Update Data Kegiatan (PUT)
    Route::put('/admin/edit-kegiatan/{id}', function (Request $request, $id) {
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
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'jam_kegiatan'        => $request->jam_kegiatan,
                'batas_registrasi'    => $request->batas_registrasi,
                'lokasi'              => $request->lokasi,
                'alamat_lengkap'      => $request->alamat_lengkap,
                'detail_aktivitas'    => $request->detail_aktivitas,
                'deskripsi_detail'    => $request->deskripsi_detail,
                'foto_kegiatan'       => $namaFoto,
                
                // UBAH BARIS INI: Gunakan strtolower agar cocok dengan ENUM huruf kecil di database
                'status_kegiatan'     => strtolower($request->status_kegiatan ?? 'buka')
            ]);

        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data agenda kegiatan sukses diperbarui!');
    });

    // 6. Kelola Relawan (Tampil Data Lengkap + Search & Filter)
    Route::get('/admin/kelola-relawan', function (Request $request) {
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

    // ==================== PERBAIKAN ERROR 404 URL MANDIRI ====================
    // Menangkap link mentah /relawan di sidebar agar langsung membuang error 404
    Route::get('/relawan', function () {
        if (session('role') === 'admin') {
            return redirect()->route('admin.relawan.index');
        }
        return redirect('/kegiatan'); 
    });

    // Tambahkan alias rute /admin/data-relawan agar link di sidebar-mu tidak eror 404
    Route::get('/admin/data-relawan', function (Request $request) {
        return redirect()->route('admin.relawan.index');
    });

    Route::get('/kelola-relawan/pdf', function () {
        return "Fungsi unduh PDF sedang dikembangkan.";
    })->name('admin.relawan.pdf');

    Route::get('/kelola-relawan/ekspor', function () {
        return "Fungsi Ekspor Excel sedang dikembangkan.";
    })->name('admin.relawan.ekspor');

    // 7. Kelola Relawan (Proses Hapus)
    Route::delete('/admin/kelola-relawan/{id_pendaftaran}', function ($id_pendaftaran) {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        DB::table('pendaftaran_relawan')->where('id_pendaftaran', $id_pendaftaran)->delete();
        return redirect('/admin/kelola-relawan')->with('pesan', 'Data pendaftaran relawan berhasil dihapus!');
    });

    // 8. Kelola Relawan (Proses Impor CSV)
    Route::post('/admin/impor-relawan', function (Request $request) {
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
                    ['nama_lengkap' => $nama, 'role' => 'relawan', 'password' => '12345678']
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
    });

    // 9. Detail Relawan
    Route::get('/admin/detail-relawan/{id_pendaftaran}', function ($id_pendaftaran) {
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
    });

    // 10. Proses Mengubah Status Seleksi Relawan
    Route::post('/admin/detail-relawan/{id_pendaftaran}/update-status', function (Request $request, $id_pendaftaran) {
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
    });

    // ==================== ROUTE KELOLA DATA KEMITRAAN / MITRA ====================
    
    // 11. Halaman Tampilan Tabel Kelola Mitra
    Route::get('/admin/kelola-mitra', function (Request $request) {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        
        $search = $request->query('search');
        $status = $request->query('status');

        $query = DB::table('mitra');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama_instansi', 'like', "%{$search}%")
                  ->orWhere('nama_penanggung_jawab', 'like', "%{$search}%");
            });
        }

        if (!empty($status) && $status !== 'semua') {
            $query->where('status_mitra', $status);
        }

        $mitra = $query->orderBy('id_mitra', 'DESC')->get();
        return view('admin.kelola_mitra', compact('mitra'));
    })->name('admin.mitra.index');

    // 12. Proses Update Status Terima/Tolak Mitra
    Route::post('/admin/kelola-mitra/{id}/update-status', function (Request $request, $id) {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        
        $statusBaru = $request->input('status_mitra'); 

        DB::table('mitra')->where('id_mitra', $id)->update([
            'status_mitra' => $statusBaru,
            'updated_at' => now()
        ]);

        return back()->with('pesan', 'Status pengajuan mitra berhasil diperbarui menjadi ' . $statusBaru . '!');
    });

    // 13. Kelola Mitra (Proses Hapus Data)
    Route::delete('/admin/kelola-mitra/{id}', function ($id) {
        if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
        
        DB::table('mitra')->where('id_mitra', $id)->delete();
        return back()->with('pesan', 'Data kemitraan berhasil dihapus dari sistem!');
    });

    // ==================== ADDED: ROUTE KELOLA DOKUMENTASI ====================
    
    // 14. Tampilan Halaman Tabel Kelola Dokumentasi
    Route::get('/admin/kelola-dokumentasi', function () {
        if (!session('id_user') || session('role') !== 'admin') { 
            return redirect('/login'); 
        }
        
        // Mengambil data dokumentasi untuk dikirimkan ke blade admin
        $dokumentasi = DB::table('dokumentasi_kegiatan')->orderBy('id_dokumentasi', 'DESC')->get();
        
        // Membuka file resources/views/admin/kelola_dokumentasi.blade.php
        return view('admin.kelola_dokumentasi', compact('dokumentasi'));
    })->name('admin.dokumentasi.index');

});