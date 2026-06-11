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

    /**
     * Tampilan Halaman Detail Kegiatan Berdasarkan ID (Sesuai Alur Tombol Lihat Detail)
     */
    public function detail($id)
    {
        // 1. Cari data kegiatan berdasarkan id_kegiatan, jika tidak ada langsung munculkan error 404
        $kegiatan = Kegiatan::where('id_kegiatan', $id)->first();

        if (!$kegiatan) {
            return redirect('/kegiatan')->with('pesan', 'Maaf, data kegiatan tidak ditemukan!');
        }

        // 2. Hitung status secara real-time berdasarkan tanggal hari ini (Supaya sinkron dengan halaman index)
        $today = Carbon::today();
        $batasRegistrasi = Carbon::parse($kegiatan->batas_registrasi);
        $tanggalPelaksanaan = $kegiatan->tanggal_pelaksanaan ? Carbon::parse($kegiatan->tanggal_pelaksanaan) : null;

        if ($batasRegistrasi->gte($today) && ($tanggalPelaksanaan === null || $tanggalPelaksanaan->gte($today))) {
            $kegiatan->status_kegiatan = 'buka';
        } elseif ($batasRegistrasi->lt($today) && $tanggalPelaksanaan !== null && $tanggalPelaksanaan->gte($today)) {
            $kegiatan->status_kegiatan = 'berjalan';
        } else {
            $kegiatan->status_kegiatan = 'selesai';
        }

        // 3. Oper data kegiatan yang sudah disisipi 'status_kegiatan' ke dalam view detail
        return view('publik.detail_kegiatan', compact('kegiatan'));
    }
}