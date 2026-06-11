<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanPublikController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. Registrasi Dibuka: Batas registrasi belum lewat DAN pelaksanaan juga belum lewat
        $kegiatanBuka = Kegiatan::where('batas_registrasi', '>=', $today)
                                ->where(function($query) use ($today) {
                                    $query->where('tanggal_pelaksanaan', '>=', $today)
                                          ->orWhereNull('tanggal_pelaksanaan');
                                })
                                ->get();

        // 2. Sedang Berlangsung: Registrasi sudah lewat, tapi pelaksanaan belum selesai
        $kegiatanBerjalan = Kegiatan::where('batas_registrasi', '<', $today)
                                    ->where('tanggal_pelaksanaan', '>=', $today)
                                    ->get();

        // 3. Sudah Selesai: Jika tanggal pelaksanaan sudah mutlak terlewati kemarin atau sebelumnya
        $kegiatanSelesai = Kegiatan::where('tanggal_pelaksanaan', '<', $today)->get();

        return view('publik.kegiatan', compact('kegiatanBuka', 'kegiatanBerjalan', 'kegiatanSelesai'));
    }
}