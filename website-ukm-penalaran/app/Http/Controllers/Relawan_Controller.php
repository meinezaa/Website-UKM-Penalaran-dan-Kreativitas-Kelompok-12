<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Ditambahkan untuk penanganan Auth Laravel

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

        // Validasi input form kiriman data pendaftar
        $request->validate([
            'id_kegiatan' => 'required',
            'nama' => 'required|string|max:255',
            'npm' => 'required',
            'whatsapp' => 'required',
            'prodi' => 'required',
            'divisi_pilihan' => 'required',
            'alasan' => 'required',
        ]);

        // Memasukkan data ke tabel pendaftaran_relawan
        DB::table('pendaftaran_relawan')->insert([
            'id_kegiatan' => $request->id_kegiatan,
            'id_user' => Auth::id(), // Mengambil id dari sesi login aktif
            'nama_lengkap' => $request->nama,
            'npm' => $request->npm,
            'no_whatsapp' => $request->whatsapp,
            'program_studi' => $request->prodi,
            'divisi_diminati' => $request->divisi_pilihan,
            'alasan_tertarik' => $request->alasan,
            'status_seleksi' => 'pending', // Status default saat baru mendaftar
            'created_at' => now(),
            'updated_at' => now(),
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
        $data = DB::table('pendaftaran_relawan as p')
            ->leftJoin('users as u', 'p.id_user', '=', 'u.id_user')
            ->leftJoin('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
            ->select('p.*', 'u.name as nama_akun', 'k.nama_kegiatan')
            ->where('p.id_user', $id_user)
            ->orderBy('p.id_pendaftaran', 'desc')
            ->first();

        // Jika user belum pernah mengisi pendaftaran sama sekali
        if (!$data) {
            return redirect()->route('relawan.index')
                ->with('error', 'Data pendaftaran tidak ditemukan. Silakan lakukan pendaftaran program terlebih dahulu.');
        }

        // Olah penamaan pendaftar untuk menyapa nama depan saja
        $nama_pendaftar = $data->nama_lengkap ?? $data->nama_akun ?? 'Calon Anggota';
        $nama_depan = explode(' ', trim($nama_pendaftar))[0];
        
        // Memastikan string status menggunakan huruf kecil agar percabangan Blade aman
        $status = strtolower($data->status_seleksi ?? 'pending');

        return view('status-pendaftaran', compact('data', 'nama_depan', 'status'));
    }
}