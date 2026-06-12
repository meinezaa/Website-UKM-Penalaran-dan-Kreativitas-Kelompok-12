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
        $jumlahRelawan = DB::table('pendaftaran_relawan')
                    ->where('status_seleksi', 'DITERIMA')
                    ->count();

        // Diubah dari $jumlahMitra menjadi $jumlahSekolah
        $jumlahSekolah = DB::table('kegiatan')
                            ->distinct('lokasi')
                            ->count('lokasi');

        $jumlahSiswaTerlibat = DB::table('pendaftaran_relawan')
                                ->where('status_seleksi', 'DITERIMA')
                                ->count() * 15;

        if ($jumlahSiswaTerlibat == 0) {
            $jumlahSiswaTerlibat = 500;
        }
        if ($jumlahSekolah == 0) {
            $jumlahSekolah = 10; 
        }

        // Pastikan di bagian compact() juga menggunakan 'jumlahSekolah'
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