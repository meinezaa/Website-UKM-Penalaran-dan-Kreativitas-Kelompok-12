<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanPublikController extends Controller
{
    /**
     * Tampilan Halaman Utama Eksplorasi Kegiatan (Daftar Kegiatan)
     */
    public function index()
    {
        // Mengunci tanggal hari ini berdasarkan waktu berjalan sistem (Tahun 2026)
        $today = Carbon::today()->format('Y-m-d');

        // 1. REGISTRASI DIBUKA (Untuk Tab 'Registrasi Dibuka')
        // Batas registrasi masih hari ini atau di masa depan (>= today) ATAU belum diisi (null)
        $kegiatanBuka = Kegiatan::where(function($query) use ($today) {
                                    $query->whereDate('batas_registrasi', '>=', $today)
                                          ->orWhereNull('batas_registrasi');
                                })
                                ->where(function($query) use ($today) {
                                    $query->whereDate('tanggal_pelaksanaan', '>=', $today)
                                          ->orWhereNull('tanggal_pelaksanaan');
                                })
                                ->get();

        // 2. SEDANG BERLANGSUNG (Untuk Tab 'Sedang Berlangsung')
        // Batas registrasi sudah lewat, TAPI tanggal pelaksanaan masih hari ini atau masa depan
        $kegiatanBerjalan = Kegiatan::whereDate('batas_registrasi', '<', $today)
                                    ->whereDate('tanggal_pelaksanaan', '>=', $today)
                                    ->get();

        // 3. SUDAH SELESAI (Untuk Tab 'Sudah Selesai')
        // Tanggal pelaksanaan sudah terlewati (< today) ATAU kolom status_kegiatan memang bernilai 'selesai'
        $kegiatanSelesai = Kegiatan::where(function($query) use ($today) {
                                    $query->whereDate('tanggal_pelaksanaan', '<', $today)
                                          ->orWhere('status_kegiatan', 'selesai');
                                })
                                ->get();

        // 4. SEMUA DATA KEGIATAN (Khusus Untuk Tab Utama 'Semua Kegiatan')
        // Mengambil total seluruh baris data yang ada di database tanpa filter tanggal
        $semuaKegiatan = Kegiatan::all();

        // Mengirimkan keempat variabel ke view 'publik.kegiatan'
        return view('publik.kegiatan', compact('kegiatanBuka', 'kegiatanBerjalan', 'kegiatanSelesai', 'semuaKegiatan'));
    }

    /**
     * Tampilan Halaman Detail Kegiatan Berdasarkan ID
     */
    public function showDetailPublik($id)
    {
        // 1. Cari data kegiatan berdasarkan id_kegiatan
        $kegiatan = Kegiatan::where('id_kegiatan', $id)->first();

        // Jika data tidak ditemukan, kembalikan ke halaman daftar dengan pesan peringatan
        if (!$kegiatan) {
            return redirect('/kegiatan')->with('pesan', 'Maaf, data kegiatan tidak ditemukan!');
        }

        // 2. Hitung status secara real-time untuk kebutuhan visual di halaman detail (Supaya sinkron)
        $today = Carbon::today();
        $batasRegistrasi = $kegiatan->batas_registrasi ? Carbon::parse($kegiatan->batas_registrasi) : null;
        $tanggalPelaksanaan = $kegiatan->tanggal_pelaksanaan ? Carbon::parse($kegiatan->tanggal_pelaksanaan) : null;

        if (($batasRegistrasi === null || $batasRegistrasi->gte($today)) && ($tanggalPelaksanaan === null || $tanggalPelaksanaan->gte($today))) {
            $kegiatan->status_kegiatan = 'buka';
        } elseif ($batasRegistrasi !== null && $batasRegistrasi->lt($today) && $tanggalPelaksanaan !== null && $tanggalPelaksanaan->gte($today)) {
            $kegiatan->status_kegiatan = 'berjalan';
        } else {
            $kegiatan->status_kegiatan = 'selesai';
        }

        // 3. Oper data kegiatan ke view 'publik.detail_kegiatan'
        return view('publik.detail_kegiatan', compact('kegiatan'));
    }
    public function submitMitra(Request $request)
{
    DB::table('mitra')->insert([
        'nama_instansi' => $request->nama_instansi,
        'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
        'email_instansi' => $request->email_instansi,
        'no_hp' => $request->no_hp,
        'jenis_kemitraan' => $request->jenis_kemitraan,
        'pesan_kolaborasi' => $request->pesan_kolaborasi,
        'status_mitra' => 'MENUNGGU',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return back()->with('sukses', 'Pengajuan kemitraan berhasil dikirim.');
}
}