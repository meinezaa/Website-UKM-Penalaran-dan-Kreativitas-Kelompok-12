<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;

class KegiatanController extends BaseController
{
    /**
     * 1. MENAMPILKAN HALAMAN UTAMA / BERANDA PUBLIK
     */
    public function beranda()
    {
        $jumlahRelawan = DB::table('pendaftaran_relawan')->where('status_seleksi', 'DITERIMA')->count();
        $jumlahSekolah = DB::table('mitra')->where('status_mitra', 'DISETUJUI')->count();
        $jumlahSiswaTerlibat = DB::table('pendaftaran_relawan')->where('status_seleksi', 'DITERIMA')->count() * 15;

        if ($jumlahSiswaTerlibat == 0) { $jumlahSiswaTerlibat = 500; }
        if ($jumlahSekolah == 0) { $jumlahSekolah = 1; }

        return view('publik.beranda', compact('jumlahRelawan', 'jumlahSekolah', 'jumlahSiswaTerlibat'));
    }

    /**
     * 2. MENAMPILKAN DAFTAR SEMUA KEGIATAN AKTIF
     */
    public function index(Request $request)
    {
        $query = Kegiatan::where('status_kegiatan', 'aktif');
        if ($request->filled('kategori')) { $query->where('kategori', $request->kategori); }
        $kegiatan = $query->orderBy('tanggal_pelaksanaan', 'asc')->get();

        return view('publik.kegiatan', compact('kegiatan'));
    }

    /**
     * 3. MENAMPILKAN HALAMAN DETAIL PROGRAM KEGIATAN
     */
    public function detail($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('publik.detail_kegiatan', compact('kegiatan'));
    }

    /**
     * HALAMAN DOKUMENTASI
     */
    public function dokumentasi()
    {
        $kegiatan = Kegiatan::with('dokumentasi')->orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('publik.relawan', compact('kegiatan'));
    }

    /**
     * 4. MENAMPILKAN DAFTAR KEGIATAN DI HALAMAN ADMIN
     */
    public function kelolaKegiatan()
    {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'desc')->get();
        return view('admin.kegiatan', compact('kegiatan')); 
    }

    /**
     * 5. MEMPROSES INPUT KEGIATAN BARU (+ UPLOAD GAMBAR)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'foto_kegiatan' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $nama_file = null;
        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
        }

        Kegiatan::create([
            'nama_kegiatan'        => $request->nama_kegiatan,
            'kategori'             => $request->kategori,
            'pendaftaran_dibuka'   => $request->pendaftaran_dibuka,
            'batas_registrasi'     => $request->batas_registrasi,
            'pengumuman_seleksi'   => $request->pengumuman_seleksi,
            'tanggal_pelaksanaan'  => $request->tanggal_pelaksanaan,
            'divisi_dibutuhkan'    => $request->divisi_dibutuhkan,
            'lokasi'               => $request->lokasi,
            'jam_kegiatan'         => $request->jam_kegiatan,
            'alamat_lengkap'       => $request->alamat_lengkap,
            'deskripsi_detail'     => $request->deskripsi_detail,
            'detail_aktivitas'     => $request->detail_aktivitas,
            'status_kegiatan'      => $request->status_kegiatan ?? 'aktif',
            'foto_kegiatan'        => $nama_file,
        ]);

        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Kegiatan baru berhasil disimpan!');
    }

    /**
     * 6. MENAMPILKAN HALAMAN FORM EDIT KEGIATAN (FIXED)
     */
    public function edit($id)
    {
        if (!session('id_user') || strtolower(session('role')) !== 'admin') {
            return redirect('/login')->withErrors(['login_error' => 'Akses ditolak! Sesi Anda berakhir atau Anda bukan Admin.']);
        }

        $kegiatan = Kegiatan::where('id_kegiatan', $id)->first();
        if (!$kegiatan) {
            return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data kegiatan tidak ditemukan!');
        }

        return view('admin.edit_kegiatan', compact('kegiatan'));
    }

    /**
     * 7. MEMPROSES UPDATE DATA KEGIATAN
     */
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::where('id_kegiatan', $id)->first();
        if (!$kegiatan) { return redirect('/admin/kelola-kegiatan')->with('pesan', 'Data tidak ditemukan!'); }

        $request->validate([
            'nama_kegiatan' => 'required',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $nama_file = $kegiatan->foto_kegiatan;
        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
        }

        $kegiatan->update([
            'nama_kegiatan'        => $request->nama_kegiatan,
            'kategori'             => $request->kategori,
            'pendaftaran_dibuka'   => $request->pendaftaran_dibuka,
            'batas_registrasi'     => $request->batas_registrasi,
            'pengumuman_seleksi'   => $request->pengumuman_seleksi,
            'tanggal_pelaksanaan'  => $request->tanggal_pelaksanaan,
            'divisi_dibutuhkan'    => $request->divisi_dibutuhkan,
            'lokasi'               => $request->lokasi,
            'jam_kegiatan'         => $request->jam_kegiatan,
            'alamat_lengkap'       => $request->alamat_lengkap,
            'deskripsi_detail'     => $request->deskripsi_detail,
            'detail_aktivitas'     => $request->detail_aktivitas,
            'status_kegiatan'      => $request->status_kegiatan,
            'foto_kegiatan'        => $nama_file,
        ]);

        return redirect('/admin/kelola-kegiatan')->with('pesan', 'Perubahan data kegiatan berhasil diperbarui!');
    }
}