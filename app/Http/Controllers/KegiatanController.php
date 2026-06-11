<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk menghitung statistik data riil

class KegiatanController extends BaseController
{
    public function index()
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