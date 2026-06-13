<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk menghitung statistik data riil

class KegiatanController extends BaseController
{
    /**
     * 1. MENAMPILKAN HALAMAN UTAMA / BERANDA PUBLIK
     */
    public function beranda()
    {
        // 1. Menghitung jumlah relawan yang lolos seleksi (Status DITERIMA)
        $jumlahRelawan = DB::table('pendaftaran_relawan')
                    ->where('status_seleksi', 'DITERIMA')
                    ->count();

        // 2. FIXED LOGIC: Menghitung total sekolah mitra riil yang disetujui oleh admin
        // Menggunakan kolom 'status_mitra' sesuai dengan struktur query yang ada pada web.php Anda
        $jumlahSekolah = DB::table('mitra')
                            ->where('status_mitra', 'DISETUJUI')
                            ->count();

        // 3. Menghitung estimasi siswa yang terlibat
        $jumlahSiswaTerlibat = DB::table('pendaftaran_relawan')
                                    ->where('status_seleksi', 'DITERIMA')
                                    ->count() * 15;

        // Kondisi Fallback jika data database masih kosong (agar tampilan awal tidak 0)
        if ($jumlahSiswaTerlibat == 0) {
            $jumlahSiswaTerlibat = 500;
        }
        if ($jumlahSekolah == 0) {
            $jumlahSekolah = 1; 
        }

        // Memastikan variabel dikirim ke view beranda
        return view('publik.beranda', compact('jumlahRelawan', 'jumlahSekolah', 'jumlahSiswaTerlibat'));
    }


    /**
     * 2. MENAMPILKAN DAFTAR SEMUA KEGIATAN AKTIF
     */
    public function index(Request $request)
    {
        $query = Kegiatan::where('status_kegiatan', 'aktif');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $kegiatan = $query
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->get();

        return view('publik.kegiatan', compact('kegiatan'));
    }

    // 3. MENAMPILKAN HALAMAN DETAIL PROGRAM KEGIATAN
    public function detail($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('publik.detail_kegiatan', compact('kegiatan'));
    }

    // HALAMAN DOKUMENTASI
    public function dokumentasi()
    {
        $kegiatan = Kegiatan::with('dokumentasi')
            ->orderBy('tanggal_pelaksanaan', 'desc')
            ->get();

        return view('publik.relawan', compact('kegiatan'));
    }

    /* ========================================================================= */
    /* FITUR TAMBAHAN: MANAGEMENT INPUT & EDIT UNTUK ADMIN (SINKRONISASI IMAGE)  */
    /* ========================================================================= */

    /**
     * 4. MENAMPILKAN DAFTAR KEGIATAN DI HALAMAN ADMIN
     */
    public function kelolaKegiatan()
    {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'desc')->get();
        return view('admin.kegiatan', compact('kegiatan')); 
    }

    /**
     * 5. MEMPROSES INPUT KEGIATAN BARU (+ UPLOAD GAMBAR)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'foto_kegiatan' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $nama_file = null;

        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan file fisik ke storage/app/public/
            $file->storeAs('public', $nama_file);
        }

        Kegiatan::create([
            'nama_kegiatan'        => $request->nama_kegiatan,
            'kategori'             => $request->kategori,
            'pendaftaran_dibuka'   => $request->pendaftaran_dibuka,
            'batas_registrasi'     => $request->batas_registrasi,
            'pengumuman_seleksi'   => $request->pengumuman_seleksi,
            'tanggal_pelaksanaan'  => $request->tanggal_pelaksanaan,
            'divisi_dibutuhkan'    => $request->divisi_dibutuhkan,
            'lokasi'               => $request->lokasi,
            'jam_kegiatan'         => $request->jam_kegiatan,
            'alamat_lengkap'       => $request->alamat_lengkap,
            'deskripsi_detail'     => $request->deskripsi_detail,
            'detail_aktivitas'     => $request->detail_aktivitas,
            'status_kegiatan'      => $request->status_kegiatan ?? 'aktif',
            'foto_kegiatan'        => $nama_file, // Menyimpan string nama file unik ke DB
        ]);

        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Kegiatan baru berhasil disimpan!');
    }

    /**
     * 6. MEMPROSES UPDATE/EDIT DATA KEGIATAN (+ FORMAT VALIDASI GAMBAR LAMA)
     */
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => 'required',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Gunakan foto lama sebagai default jika tidak upload foto baru
        $nama_file = $kegiatan->foto_kegiatan;

        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan file fisik baru ke storage/app/public/
            $file->storeAs('public', $nama_file);
        }

        $kegiatan->update([
            'nama_kegiatan'        => $request->nama_kegiatan,
            'kategori'             => $request->kategori,
            'pendaftaran_dibuka'   => $request->pendaftaran_dibuka,
            'batas_registrasi'     => $request->batas_registrasi,
            'pengumuman_seleksi'   => $request->pengumuman_seleksi,
            'tanggal_pelaksanaan'  => $request->tanggal_pelaksanaan,
            'divisi_dibutuhkan'    => $request->divisi_dibutuhkan,
            'lokasi'               => $request->lokasi,
            'jam_kegiatan'         => $request->jam_kegiatan,
            'alamat_lengkap'       => $request->alamat_lengkap,
            'deskripsi_detail'     => $request->deskripsi_detail,
            'detail_aktivitas'     => $request->detail_aktivitas,
            'status_kegiatan'      => $request->status_kegiatan,
            'foto_kegiatan'        => $nama_file,
        ]);

        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Perubahan data kegiatan berhasil diperbarui!');
    }
}