<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Kegiatan;

class KegiatanController extends BaseController
{
    public function index()
    {
        $kegiatan = Kegiatan::where('status_kegiatan', 'aktif')
                            ->orderBy('tanggal_pelaksanaan', 'asc')
                            ->get();

        return view('publik.kegiatan', compact('kegiatan'));
    }

    public function detail($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('publik.detail_kegiatan', compact('kegiatan'));
    }
}