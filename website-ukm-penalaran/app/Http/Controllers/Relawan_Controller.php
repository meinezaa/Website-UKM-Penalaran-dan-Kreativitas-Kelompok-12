<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelawanController extends Controller
{
    public function index()
    {
        // Mengambil data kegiatan dengan query builder Laravel beserta fallback-nya
        $sd = DB::table('kegiatan')
            ->where('kategori', 'sd')
            ->orderBy('id_kegiatan', 'desc')
            ->first() ?? (object)['id_kegiatan' => '0', 'nama_kegiatan' => 'Program Sekolah Dasar'];

        $slb = DB::table('kegiatan')
            ->where('kategori', 'slb')
            ->orderBy('id_kegiatan', 'desc')
            ->first() ?? (object)['id_kegiatan' => '0', 'nama_kegiatan' => 'Program Sekolah Luar Biasa'];

        $yayasan = DB::table('kegiatan')
            ->where('kategori', 'yayasan')
            ->orderBy('id_kegiatan', 'desc')
            ->first() ?? (object)['id_kegiatan' => '0', 'nama_kegiatan' => 'Program Yayasan & Komunitas'];

        return view('relawan', compact('sd', 'slb', 'yayasan'));
    }
}