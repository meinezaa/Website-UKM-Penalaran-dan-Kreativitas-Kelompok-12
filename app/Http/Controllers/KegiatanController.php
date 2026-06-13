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
}