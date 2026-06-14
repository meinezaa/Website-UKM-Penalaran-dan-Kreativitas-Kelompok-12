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
        // Menyederhanakan query filter berdasarkan string status agar sinkron dengan data dari dashboard admin
        
        // 1. REGISTRASI DIBUKA (Mengakomodasi status 'aktif' atau 'buka')
        $kegiatanBuka = Kegiatan::whereIn('status_kegiatan', ['aktif', 'buka', 'Aktif', 'Buka'])->get();

        // 2. SEDANG BERLANGSUNG (Mengakomodasi status 'berjalan' atau 'proses')
        $kegiatanBerjalan = Kegiatan::whereIn('status_kegiatan', ['berjalan', 'proses', 'Berjalan', 'Proses'])->get();

        // 3. SUDAH SELESAI (Mengakomodasi status 'selesai')
        $kegiatanSelesai = Kegiatan::whereIn('status_kegiatan', ['selesai', 'Selesai'])->get();

        // 4. SEMUA DATA KEGIATAN (Khusus Untuk Tab Utama 'Semua Kegiatan')
        $semuaKegiatan = Kegiatan::all();

        return view('publik.kegiatan', compact('kegiatanBuka', 'kegiatanBerjalan', 'kegiatanSelesai', 'semuaKegiatan'));
    }

    /**
     * Tampilan Halaman Detail Kegiatan Berdasarkan ID
     */
    public function showDetailPublik($id)
    {
        $kegiatan = Kegiatan::where('id_kegiatan', $id)->first();

        if (!$kegiatan) {
            return redirect('/kegiatan')->with('pesan', 'Maaf, data kegiatan tidak ditemukan!');
        }

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

        return view('publik.detail_kegiatan', compact('kegiatan'));
    }

    /**
     * Handle proses submit formulir kemitraan
     */
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

    /**
     * Handle proses submit formulir pendaftaran relawan
     */
    public function submitRelawan(Request $request, $id)
    {
        $request->validate([
            'id_kegiatan'       => 'required',
            'nama_lengkap'      => 'required|string|max:255',
            'no_hp'             => 'required|numeric',
            'email'             => 'required|email',
            'umur'              => 'required|numeric',
            'jenis_kelamin'     => 'required',
            'asal_prodi'        => 'required',
            'pilihan_divisi_1'  => 'required',
            'pilihan_divisi_2'  => 'required',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'persetujuan'       => 'required',
        ]);

        // --- PROTEKSI ENUM METODE PEMBAYARAN ---
        $metodePembayaran = $request->metode_pembayaran;
        if ($metodePembayaran === 'transfer bni') {
            $metodePembayaran = 'bni';
        }

        $namaFileBukti = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $namaFileBukti = 'bukti_relawan_' . $id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto'), $namaFileBukti);
        }

        // MENYESUAIKAN 100% DENGAN STRUKTUR DATABASE BARU
        DB::table('pendaftaran_relawan')->insert([
            'id_user'             => session('id_user') ?? 1,
            'id_kegiatan'         => $request->id_kegiatan,
            'nama_lengkap'        => $request->nama_lengkap ?? 'Tanpa Nama', 
            'no_hp'               => $request->no_hp,
            'umur'                => $request->umur,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'asal_prodi'          => $request->asal_prodi,
            'pilihan_divisi_1'    => $request->pilihan_divisi_1,
            'pilihan_divisi_2'    => $request->pilihan_divisi_2, 
            'portofolio'          => $request->portofolio,
            'pengalaman_keahlian' => $request->deskripsi, 
            'metode_pembayaran'   => $metodePembayaran,   
            'bukti_pembayaran'    => $namaFileBukti,
            'status_seleksi'      => 'Proses',            
            'created_at'          => now(),
            'updated_at'          => now()
        ]);

        // Ambil data kegiatan untuk mendapatkan link WhatsApp grup tujuan secara dinamis
        $kegiatan = Kegiatan::where('id_kegiatan', $id)->first();
        $linkWhatsapp = ($kegiatan && $kegiatan->link_grup_wa) ? $kegiatan->link_grup_wa : 'https://chat.whatsapp.com/ContohGrupDefault';

        return redirect('/kegiatan')->with([
            'sukses_daftar' => true,
            'link_wa'       => $linkWhatsapp
        ]);
    }
}