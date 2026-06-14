<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// ==================== IMPORT CONTROLLER ====================
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanController; 
use App\Http\Controllers\KegiatanPublikController;
use App\Http\Controllers\UkmController; 
use App\Http\Controllers\TimController; // Ditambahkan untuk Kelola Tim Admin

// ==================== IMPORT MODEL YANG DIBUTUHKAN ====================
use App\Models\Division;
use App\Models\VisionMission;
use App\Models\Bph;
use App\Models\Setting;
use App\Models\Program;

// =========================================================================
// ==================== ROUTE PUBLIK (FRONTEND) ============================
// =========================================================================

// Route Beranda
Route::get('/', [KegiatanController::class, 'beranda'])->name('beranda');
Route::get('/beranda', [KegiatanController::class, 'beranda']);

// Halaman Utama UKM (Sosmed, Visi, Misi, BPH, Divisi & Proker)
Route::get('/ukm', function() { 
    // 1. Data Asli Bawaan Halaman UKM Kamu (Jangan Diganggu)
    $divisions     = Division::get();
    $visis         = VisionMission::where('type', 'visi')->get();
    $misis         = VisionMission::where('type', 'misi')->get();
    $bph_ketua     = Bph::where('role', 'Ketua Umum')->get();
    $bph_sekre     = Bph::where('role', 'LIKE', '%Sekretaris%')->get();
    $bph_bendahara = Bph::where('role', 'LIKE', '%Bendahara%')->get();
    $medsos        = Setting::pluck('value', 'key')->toArray();
    $programs      = Program::get();

    // 2. GABUNGAN PINTAR: Ambil BPH Bidang Diksos dari tabel 'teams'
    $bph_teams     = DB::table('teams')
                        ->where('jabatan', 'NOT LIKE', '%Staf Ahli%')
                        ->get(); 

    // 3. GABUNGAN PINTAR: Ambil khusus Mas Andi Pratama (Staf Ahli) dari tabel 'teams'
    $staf_teams    = DB::table('teams')
                        ->where('jabatan', 'LIKE', '%Staf Ahli%')
                        ->get(); 

    // 4. Kirim SEMUA variabel ke View Blade
    return view('layouts.ukm', compact(
        'medsos', 
        'visis', 
        'misis', 
        'bph_ketua', 
        'bph_sekre', 
        'bph_bendahara', 
        'divisions', 
        'programs',
        'bph_teams',
        'staf_teams'
    ));
})->name('ukm');

Route::get('/tentang', function () {
    $profil = DB::table('visions_missions')->first();
    return view('layouts.tentang', compact('profil'));
});

Route::get('/upnmengajar', function () { 
    return view('layouts.upnmengajar'); 
});

// Menampilkan Halaman Tim via UkmController
Route::get('/tim', [UkmController::class, 'Tim'])->name('tim.index');

// ==================== REVISI BAGIAN KEGIATAN PUBLIK ====================
// Mengarahkan ke KegiatanPublikController agar data terproses dengan benar ke view publik
Route::get('/kegiatan', [KegiatanPublikController::class, 'index'])->name('kegiatan.index');
// =======================================================================

// Route Utama Halaman Galeri Artikel/Dokumentasi Publik
Route::get('/relawan', function () {
    $dokumentasi = DB::table('dokumentasi_kegiatan')
        ->join('kegiatan', 'dokumentasi_kegiatan.id_kegiatan', '=', 'kegiatan.id_kegiatan')
        ->select('dokumentasi_kegiatan.*', 'kegiatan.nama_kegiatan')
        ->orderBy('dokumentasi_kegiatan.id_dokumentasi', 'DESC')
        ->get();

    return view('publik.relawan', compact('dokumentasi'));
})->name('relawan');

// Route Detail Dokumentasi
Route::get('/relawan/{id}', function ($id) {
    $dokumentasi = DB::table('dokumentasi_kegiatan')
        ->join('kegiatan', 'dokumentasi_kegiatan.id_kegiatan', '=', 'kegiatan.id_kegiatan')
        ->select('dokumentasi_kegiatan.*', 'kegiatan.nama_kegiatan')
        ->where('dokumentasi_kegiatan.id_dokumentasi', $id)
        ->first();

    if (!$dokumentasi) {
        return redirect('/relawan');
    }

    return view('publik.baca_dokumentasi', compact('dokumentasi'));
})->name('relawan.detail');

// Detail Agenda Kegiatan untuk Publik
Route::get('/agenda/{id}', [KegiatanPublikController::class, 'showDetailPublik'])->name('kegiatan.detail');


// =========================================================================
// ==================== ROUTE AUTENTIKASI (LOGIN/LOGOUT) ===================
// =========================================================================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');


// =========================================================================
// ==================== ROUTE REGISTRASI RELAWAN & MITRA ===================
// =========================================================================

Route::get('/formulir/{id}', function ($id) {
    if (!session('id_user')) { 
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar.'); 
    }
    
    $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
    
    if (!$kegiatan) {
        return redirect('/kegiatan')->with('error', 'Kegiatan tidak ditemukan atau telah berakhir.');
    }

    return view('publik.formulir', compact('kegiatan')); 
})->name('relawan.formulir');

Route::get('/formulir-mitra', function () {
    return view('publik.formulir_mitra');
})->name('mitra.formulir');

// Submit Formulir pendaftaran relawan & mitra
Route::post('/agenda/{id}/daftar-relawan', [KegiatanPublikController::class, 'submitRelawan'])->name('relawan.daftar');
Route::post('/mitra/daftar', [KegiatanPublikController::class, 'submitMitra'])->name('mitra.daftar');


// =========================================================================
// ==================== ROUTE ADMIN PANEL (GROUP) ==========================
// =========================================================================
Route::group([], function () {
    
    // Dashboard Utama Admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // ------------------ 1. KELOLA KEGIATAN ------------------
    Route::get('/admin/kelola-kegiatan', [KegiatanController::class, 'kelolaKegiatan'])->name('admin.kegiatan.index');

    Route::get('/admin/tambah-kegiatan', function () {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        return view('admin.tambah_kegiatan');
    })->name('admin.kegiatan.tambah');

    Route::post('/admin/kelola-kegiatan/store', [KegiatanController::class, 'store'])->name('admin.kegiatan.store');

    Route::get('/admin/kelola-kegiatan/{id}', function ($id) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
        if (!$kegiatan) { return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!'); }
        return view('admin.detail_kegiatan', compact('kegiatan'));
    })->name('admin.kegiatan.detail');

    Route::delete('/admin/kelola-kegiatan/{id}', function ($id) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Kegiatan berhasil dihapus!');
    })->name('admin.kegiatan.destroy');

    Route::get('/admin/edit-kegiatan/{id}', [KegiatanController::class, 'edit'])->name('admin.kegiatan.edit');
    Route::put('/admin/edit-kegiatan/{id}', [KegiatanController::class, 'update'])->name('admin.kegiatan.update');


    // ------------------ 2. KELOLA RELAWAN ------------------
    Route::get('/admin/kelola-relawan', function (Request $request) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $search = $request->input('search');
        $divisi = $request->input('divisi');

        // 🌟 REVISI: Menggunakan leftJoin pada tabel kegiatan agar data impor yang id_kegiatan-nya tidak sinkron/default tetap paksa muncul di list
        $query = DB::table('pendaftaran_relawan as p')
                    ->join('users as u', 'p.id_user', '=', 'u.id_user')
                    ->leftJoin('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
                    ->select('p.*', 'u.nama_lengkap', 'u.email', DB::raw("COALESCE(k.nama_kegiatan, 'Kegiatan Impor / Default') as nama_kegiatan"));

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

    Route::get('/admin/data-relawan', function () {
        return redirect()->route('admin.relawan.index');
    });
    
    Route::get('/admin/kelola-relawan/pdf', [AdminDashboardController::class, 'eksporPdf'])->name('admin.relawan.pdf');
    Route::get('/admin/kelola-relawan/ekspor', [AdminDashboardController::class, 'eksporExcel'])->name('admin.relawan.ekspor');
    
    Route::get('/admin/kelola-relawan/detail/{id_pendaftaran}', function ($id_pendaftaran) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        
        $relawan = DB::table('pendaftaran_relawan as p')
                    ->join('users as u', 'p.id_user', '=', 'u.id_user')
                    ->leftJoin('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
                    ->select('p.*', 'u.nama_lengkap', 'u.email', 'k.id_kegiatan', 'k.nama_kegiatan', 'k.lokasi', 'k.tanggal_pelaksanaan', 'k.kategori')
                    ->where('p.id_pendaftaran', $id_pendaftaran)
                    ->first();

        if (!$relawan) { return redirect('/admin/kelola-relawan')->with('pesan', 'Data relawan tidak ditemukan!'); }

        $relawan->kegiatan = (object) [
            'id_kegiatan'         => $relawan->id_kegiatan ?? 1,
            'nama_kegiatan'       => $relawan->nama_kegiatan ?? 'Kegiatan Impor / Default',
            'lokasi'              => $relawan->lokasi ?? '-',
            'tanggal_pelaksanaan' => $relawan->tanggal_pelaksanaan ?? now()->toDateString(),
            'kategori'            => $relawan->kategori ?? 'Umum',
        ];
        return view('admin.detail_relawan', compact('relawan'));
    })->name('admin.relawan.detail');

    Route::post('/admin/kelola-relawan/detail/{id_pendaftaran}/update-status', function (Request $request, $id_pendaftaran) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $statusUppercase = strtoupper($request->status_seleksi);
        DB::table('pendaftaran_relawan')->where('id_pendaftaran', $id_pendaftaran)->update([
            'status_seleksi' => $statusUppercase,
            'updated_at'     => now()
        ]);
        return redirect()->back()->with('pesan', 'Status seleksi relawan berhasil diperbarui!');
    })->name('admin.relawan.update_status');

    Route::delete('/admin/kelola-relawan/delete/{id_pendaftaran}', function ($id_pendaftaran) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        DB::table('pendaftaran_relawan')->where('id_pendaftaran', $id_pendaftaran)->delete();
        return redirect('/admin/kelola-relawan')->with('pesan', 'Data pendaftaran relawan berhasil dihapus!');
    })->name('admin.relawan.destroy');

    // Fungsi Impor CSV Lengkap Kolom 11 & 12
    Route::post('/admin/kelola-relawan/impor', function (Request $request) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
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
                $pembayaran    = $data[10] ?? 'Transfer BCA'; 
                $bukti         = $data[11] ?? 'default_bukti.png';

                if (strtoupper($jk) === 'L' || strtolower($jk) === 'laki-laki') {
                    $jk = 'Laki-laki';
                } elseif (strtoupper($jk) === 'P' || strtolower($jk) === 'perempuan') {
                    $jk = 'Perempuan';
                }

                if (strtoupper($pembayaran) === 'BNI') {
                    $pembayaranFinal = 'BNI';
                } else {
                    $pembayaranFinal = 'Transfer BCA';
                }

                $kegiatan = DB::table('kegiatan')->where('nama_kegiatan', 'LIKE', "%{$nama_kegiatan}%")->first();
                $id_kegiatan = $kegiatan ? $kegiatan->id_kegiatan : 1; 

                DB::table('users')->updateOrInsert(
                    ['email' => $email],
                    ['nama_lengkap' => $nama, 'role' => 'user', 'password' => bcrypt('12345678')]
                );
                $user = DB::table('users')->where('email', $email)->first();

                $insertData = [
                    'id_user'           => $user->id_user,
                    'id_kegiatan'       => $id_kegiatan, 
                    'no_hp'             => $no_hp,
                    'umur'              => $umur,
                    'jenis_kelamin'     => $jk,
                    'asal_prodi'        => $prodi,
                    'pilihan_divisi_1'  => $divisi_1,
                    'pilihan_divisi_2'  => $divisi_2,
                    'status_seleksi'    => 'Proses',
                    'metode_pembayaran' => $pembayaranFinal,
                    'bukti_pembayaran'  => $bukti
                ];

                if (\Schema::hasColumn('pendaftaran_relawan', 'alasan_bergabung')) {
                    $insertData['alasan_bergabung'] = $alasan;
                } elseif (\Schema::hasColumn('pendaftaran_relawan', 'alasan')) {
                    $insertData['alasan'] = $alasan;
                }

                DB::table('pendaftaran_relawan')->insert($insertData);
            }
            fclose($handle);
        }
        return redirect('/admin/kelola-relawan')->with('pesan', 'Data CSV berhasil di-impor!');
    })->name('admin.relawan.impor');

    
    // ------------------ 3. KELOLA DOKUMENTASI ------------------
    Route::get('/admin/kelola-dokumentasi', function () {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }

        $dokumentasi = DB::table('dokumentasi_kegiatan')
            ->join('kegiatan', 'dokumentasi_kegiatan.id_kegiatan', '=', 'kegiatan.id_kegiatan')
            ->select('dokumentasi_kegiatan.*', 'kegiatan.nama_kegiatan')
            ->orderBy('dokumentasi_kegiatan.id_dokumentasi', 'DESC')
            ->get();

        $kegiatan = DB::table('kegiatan')->get();
        return view('admin.kelola_dokumentasi', compact('dokumentasi', 'kegiatan'));
    })->name('admin.dokumentasi');

    Route::get('/admin/tambah-dokumentasi', function () {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $kegiatan = DB::table('kegiatan')->get();
        return view('admin.tambah_dokumentasi', compact('kegiatan'));
    })->name('admin.dokumentasi.tambah');

    Route::post('/admin/tambah-dokumentasi', function (Request $request) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $arrFoto = []; 

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $namaFoto = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('foto'), $namaFoto);
                $arrFoto[] = $namaFoto;
            }
        }

        $stringFoto = !empty($arrFoto) ? implode(',', $arrFoto) : null;

        DB::table('dokumentasi_kegiatan')->insert([
            'id_kegiatan' => $request->id_kegiatan,
            'judul_foto'  => $request->judul_foto, 
            'deskripsi'   => $request->deskripsi,  
            'foto'        => $stringFoto,          
            'created_at'  => now()
        ]);

        return redirect('/admin/kelola-dokumentasi')->with('pesan', 'Artikel dokumentasi berhasil diterbitkan!');
    })->name('admin.dokumentasi.store');

    Route::put('/admin/update-dokumentasi/{id}', function (Request $request, $id) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }

        $dokumentasi = DB::table('dokumentasi_kegiatan')->where('id_dokumentasi', $id)->first();
        if (!$dokumentasi) { return redirect()->back()->with('error', 'Data tidak ditemukan!'); }

        $stringFoto = $dokumentasi->foto;

        if ($request->hasFile('foto')) {
            $arrFoto = [];
            foreach ($request->file('foto') as $file) {
                $namaFoto = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('foto'), $namaFoto);
                $arrFoto[] = $namaFoto;
            }
            $stringFoto = implode(',', $arrFoto);
        }

        DB::table('dokumentasi_kegiatan')->where('id_dokumentasi', $id)->update([
            'id_kegiatan' => $request->id_kegiatan,
            'judul_foto'  => $request->judul_foto,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $stringFoto, 
            'updated_at'  => now()
        ]);

        return redirect('/admin/kelola-dokumentasi')->with('pesan', 'Data dokumentasi berhasil diperbarui!');
    })->name('admin.dokumentasi.update');

    Route::delete('/admin/hapus-dokumentasi/{id}', function ($id) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        DB::table('dokumentasi_kegiatan')->where('id_dokumentasi', $id)->delete();
        return redirect('/admin/kelola-dokumentasi')->with('pesan', 'Dokumentasi berhasil dihapus');
    })->name('admin.hapus-dokumentasi');


    // ------------------ 4. KELOLA MITRA ------------------
    Route::get('/admin/kelola-mitra', function (Request $request) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $search = $request->input('search');
        $status = $request->input('status');

        $query = DB::table('mitra');
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama_instansi', 'LIKE', "%{$search}%")
                  ->orWhere('nama_penanggung_jawab', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($status) && $status !== 'semua') { $query->where('status_mitra', $status); }

        $mitra = $query->orderBy('id_mitra', 'DESC')->get();
        return view('admin.kelola_mitra', compact('mitra'));
    })->name('admin.mitra.index');

    Route::post('/admin/kelola-mitra/{id}/update-status', function (Request $request, $id) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        DB::table('mitra')->where('id_mitra', $id)->update([
            'status_mitra' => $request->status_mitra, 'updated_at' => now()
        ]);
        return redirect()->back()->with('pesan', 'Status kemitraan berhasil diperbarui!');
    })->name('admin.mitra.update_status');

    Route::delete('/admin/kelola-mitra/{id}', function ($id) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        DB::table('mitra')->where('id_mitra', $id)->delete();
        return redirect('/admin/kelola-mitra')->with('pesan', 'Data kemitraan berhasil dihapus!');
    })->name('admin.mitra.destroy');


    // ------------------ 5. KELOLA PROGRAM KERJA UPN MENGAJAR ------------------
    Route::get('/admin/kelola-upnmengajar', function () {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $profil = DB::table('visions_missions')->first();
        return view('admin.kelola_upnmengajar', compact('profil'));
    })->name('admin.kelola_upnmengajar');

    Route::post('/admin/kelola-upnmengajar/update', function (Request $request) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $first = DB::table('visions_missions')->first();
        if ($first) {
            DB::table('visions_missions')->where('id', $first->id)->update([
                'vision' => $request->vision, 'mission' => $request->mission, 'updated_at' => now()
            ]);
        } else {
            DB::table('visions_missions')->insert([
                'vision' => $request->vision, 'mission' => $request->mission, 'created_at' => now(), 'updated_at' => now()
            ]);
        }
        return redirect()->back()->with('pesan', 'Visi Misi diperbarui!');
    })->name('admin.kelola_upnmengajar.update');


    // ------------------ 6. KELOLA DATA KOMPONEN HALAMAN UKM ------------------
    Route::get('/admin/kelola-ukm', function () {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        
        $divisions     = Division::get();
        $programs      = Program::get(); 
        $visis         = VisionMission::where('type', 'visi')->get();
        $misis         = VisionMission::where('type', 'misi')->get();
        $bph_ketua     = Bph::where('role', 'Ketua Umum')->get();
        $bph_sekre     = Bph::where('role', 'LIKE', '%Sekretaris%')->get();
        $bph_bendahara = Bph::where('role', 'LIKE', '%Bendahara%')->get();
        $medsos        = Setting::pluck('value', 'key')->toArray();

        return view('admin.kelola_ukm', compact('medsos', 'visis', 'misis', 'bph_ketua', 'bph_sekre', 'bph_bendahara', 'divisions', 'programs'));
    })->name('admin.kelola_ukm');

    Route::post('/admin/kelola-ukm/store', function (Request $request) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $target = $request->target_table;

        if ($target == 'visions_missions') {
            $item = new VisionMission();
            $item->type = $request->type; 
            $item->content = $request->content;
            $item->save();
        } elseif ($target == 'bph_members') {
            $item = new Bph();
            $item->name = $request->name;
            $item->role = $request->role; 
            $item->major_year = $request->major_year;
            
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $namaFoto = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('foto'), $namaFoto);
                $item->photo = $namaFoto;
            } else {
                $item->photo = 'default.jpg';
            }
            $item->save();
        } elseif ($target == 'divisions') {
            $item = new Division();
            $item->name = $request->name;
            $item->description = $request->description;
            $item->save();
        }

        return redirect()->back()->with('pesan', 'Data komponen baru berhasil ditambahkan!');
    })->name('admin.kelola_ukm.store');

    Route::post('/admin/kelola-ukm/update', function (Request $request) {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') { return redirect('/login'); }
        $target = $request->target_table;
        $id = $request->id;

        if ($target == 'visions_missions') {
            $item = VisionMission::find($id);
            if ($item) { $item->content = $request->content; $item->save(); }
        } elseif ($target == 'bph_members') {
            $item = Bph::find($id);
            if ($item) {
                $item->name = $request->name;
                $item->major_year = $request->major_year;
                if ($request->hasFile('photo')) {
                    $file = $request->file('photo');
                    $namaFoto = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('foto'), $namaFoto);
                    $item->photo = $namaFoto;
                }
                $item->save();
            }
        } elseif ($target == 'divisions') {
            $item = Division::find($id);
            if ($item) { $item->name = $request->name; $item->description = $request->description; $item->save(); }
        } elseif ($target == 'programs') {
            $item = Program::find($id);
            if ($item) { $item->name = $request->name; $item->description = $request->description; $item->save(); }
        }

        return redirect()->back()->with('pesan', 'Data komponen UKM berhasil diperbarui!');
    })->name('admin.kelola_ukm.update');


    // ------------------ 7. KELOLA DROPDOWN TENTANG: TIM UPN MENGAJAR ------------------
    Route::get('/admin/kelola-tim', [TimController::class, 'index'])->name('admin.kelola_tim');
    Route::post('/admin/kelola-tim', [TimController::class, 'store'])->name('admin.kelola_tim.store');
    Route::delete('/admin/kelola-tim/{id}', [TimController::class, 'destroy'])->name('admin.kelola_tim.destroy');

    Route::put('/admin/kelola-tim/{id}', [TimController::class, 'update'])->name('admin.kelola_tim.update');
});