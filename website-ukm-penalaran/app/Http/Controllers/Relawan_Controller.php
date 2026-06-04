<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RelawanController extends Controller
{
    public function index()
    {
        // Mengambil data kegiatan dengan query builder Laravel beserta fallback-nya
        // Catatan: Menyesuaikan properti fallback agar cocok dengan struktur tabel kegiatan asli Anda
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

    // 1. HALAMAN FORM PENDAFTARAN RELAWAN SEKOLAH DASAR (SD)
    public function relawanSd(Request $request)
    {
        $id_kegiatan = $request->query('id');

        // Pengaman: Jika ID kosong, bernilai '0', atau tidak valid
        if (!$id_kegiatan || $id_kegiatan === '0') {
            return redirect()->route('relawan.index')
                ->with('error', 'Maaf, pendaftaran untuk program Sekolah Dasar saat ini belum tersedia atau sedang ditutup.');
        }

        // Ambil data detail kegiatan dari database berdasarkan ID
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->first();

        // Pengaman: Jika data kegiatan ternyata tidak ditemukan di database
        if (!$kegiatan) {
            return redirect()->route('relawan.index')
                ->with('error', 'Kegiatan Sekolah Dasar tidak ditemukan.');
        }

        // AMBIL DATA DIVISI UNTUK PROGRAM SD
        $divisi_kegiatan = DB::table('divisi_kegiatan')
            ->where('id_kegiatan', $id_kegiatan)
            ->get();

        // Kirim data kegiatan dan divisi ke blade relawan-sd
        return view('relawan-sd', compact('kegiatan', 'divisi_kegiatan'));
    }

    // 2. HALAMAN FORM PENDAFTARAN RELAWAN SEKOLAH LUAR BIASA (SLB)
    public function relawanSlb(Request $request)
    {
        $id_kegiatan = $request->query('id');

        // Pengaman: Jika ID kosong, bernilai '0', atau tidak valid
        if (!$id_kegiatan || $id_kegiatan === '0') {
            return redirect()->route('relawan.index')
                ->with('error', 'Maaf, pendaftaran untuk program Sekolah Luar Biasa saat ini belum tersedia atau sedang ditutup.');
        }

        // Ambil data detail kegiatan dari database berdasarkan ID
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->first();

        // Pengaman: Jika data kegiatan ternyata tidak ditemukan di database
        if (!$kegiatan) {
            return redirect()->route('relawan.index')
                ->with('error', 'Kegiatan Sekolah Luar Biasa tidak ditemukan.');
        }

        // AMBIL DATA DIVISI UNTUK PROGRAM SLB
        $divisi_kegiatan = DB::table('divisi_kegiatan')
            ->where('id_kegiatan', $id_kegiatan)
            ->get();

        // Kirim data kegiatan dan divisi ke blade relawan-slb
        return view('relawan-slb', compact('kegiatan', 'divisi_kegiatan'));
    }

    // 3. HALAMAN FORM PENDAFTARAN RELAWAN YAYASAN & KOMUNITAS
    public function relawanYayasan(Request $request)
    {
        $id_kegiatan = $request->query('id');

        // Pengaman: Jika ID kosong, bernilai '0', atau tidak valid
        if (!$id_kegiatan || $id_kegiatan === '0') {
            return redirect()->route('relawan.index')
                ->with('error', 'Maaf, pendaftaran untuk program Yayasan & Komunitas saat ini belum tersedia atau sedang ditutup.');
        }

        // Ambil data detail kegiatan dari database berdasarkan ID
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id_kegiatan)->first();

        // Pengaman: Jika data kegiatan ternyata tidak ditemukan di database
        if (!$kegiatan) {
            return redirect()->route('relawan.index')
                ->with('error', 'Kegiatan Yayasan & Komunitas tidak ditemukan.');
        }

        // AMBIL DATA DIVISI UNTUK PROGRAM YAYASAN
        $divisi_kegiatan = DB::table('divisi_kegiatan')
            ->where('id_kegiatan', $id_kegiatan)
            ->get();

        // Kirim data kegiatan dan divisi ke blade relawan-yayasan
        return view('relawan-yayasan', compact('kegiatan', 'divisi_kegiatan'));
    }

    // 4. PROSES MENYIMPAN DATA PENDAFTARAN DARI BLADE FORMULIR
    public function simpanPendaftaran(Request $request)
    {
        // Validasi wajib masuk akun terlebih dahulu
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar.');
        }

        // Validasi input form disesuaikan 100% dengan struktur ENUM & kriteria tabel pendaftaran_relawan Anda
        $request->validate([
            'id_kegiatan'       => 'required',
            'no_hp'             => 'required|string|max:20',
            'umur'              => 'required|integer|min:15',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'asal_prodi'        => 'required|string|max:100',
            'pilihan_divisi_1'  => 'required|in:Sekretaris,Bendahara,Acara,Humas,Perlengkapan,Konsumsi,PDD,Sponsorship',
            'pilihan_divisi_2'  => 'required|in:Sekretaris,Bendahara,Acara,Humas,Perlengkapan,Konsumsi,PDD,Sponsorship',
            'portofolio'        => 'required|string|max:255',
            'pengalaman_keahlian' => 'required|string',
        ]);

        // Memasukkan data ke tabel pendaftaran_relawan asli sesuai struktur database Anda
        // Note: Kolom created_at & updated_at tidak dimasukkan karena tidak ada pada skema SQL pendaftaran_relawan Anda
        DB::table('pendaftaran_relawan')->insert([
            'id_user'             => Auth::id(), // Mengambil id dari sesi login (menggunakan primary key id_user)
            'id_kegiatan'         => $request->id_kegiatan,
            'no_hp'               => $request->no_hp,
            'umur'                => $request->umur,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'asal_prodi'          => $request->asal_prodi,
            'pilihan_divisi_1'    => $request->pilihan_divisi_1,
            'pilihan_divisi_2'    => $request->pilihan_divisi_2,
            'portofolio'          => $request->portofolio,
            'pengalaman_keahlian' => $request->pengalaman_keahlian,
            'metode_pembayaran'   => $request->metode_pembayaran ?? null, // Mengikuti aturan default di database
            'bukti_pembayaran'    => $request->bukti_pembayaran ?? '-',    // Menghindari error kosong jika form opsional
            'status_seleksi'      => 'pending',                            // Nilai enum default pendaftaran
        ]);

        // Setelah berhasil menyimpan, langsung alihkan ke halaman status pendaftaran
        return redirect()->route('pendaftaran.status')->with('sukses', 'Pendaftaran Anda berhasil dikirim!');
    }

    // 5. HALAMAN STATUS PENDAFTARAN TERAKHIR USER
    public function statusPendaftaran()
    {
        // Pengaman: Wajib login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $id_user = Auth::id();

        // Ambil pendaftaran terakhir milik user yang sedang login beserta nama kegiatan relawannya
        // Penyesuaian Join: u.id_user menggantikan u.id, u.nama_lengkap menggantikan u.name
        $data = DB::table('pendaftaran_relawan as p')
            ->leftJoin('users as u', 'p.id_user', '=', 'u.id_user')
            ->leftJoin('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
            ->select('p.*', 'u.nama_lengkap', 'k.nama_kegiatan')
            ->where('p.id_user', $id_user)
            ->orderBy('p.id_pendaftaran', 'desc')
            ->first();

        // Jika user belum pernah mengisi pendaftaran sama sekali
        if (!$data) {
            return redirect()->route('relawan.index')
                ->with('error', 'Data pendaftaran tidak ditemukan. Silakan lakukan pendaftaran program terlebih dahulu.');
        }

        // Olah penamaan pendaftar untuk menyapa nama depan saja
        $nama_pendaftar = $data->nama_lengkap ?? 'Calon Anggota';
        $nama_depan = explode(' ', trim($nama_pendaftar))[0];
        
        // Memastikan string status menggunakan huruf kecil agar percabangan Blade aman
        $status = strtolower($data->status_seleksi ?? 'pending');

        return view('status-pendaftaran', compact('data', 'nama_depan', 'status'));
    }
}