<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Bagian ini diubah untuk memanggil Routing Controller bawaan inti Laravel 11
use Illuminate\Routing\Controller as BaseController; 
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\PendaftaranRelawan;
use Illuminate\Support\Facades\Auth;

// Bagian ini diubah dari "extends Controller" menjadi "extends BaseController"
class AdminDashboardController extends BaseController 
{
    public function index()
    {
        // 1. AMBIL STATISTIK DINAMIS
        // Menghitung total user yang rolenya 'user'
        $count_relawan = User::where('role', 'user')->count();

        // Menghitung kegiatan yang statusnya 'aktif'
        $count_program = Kegiatan::where('status_kegiatan', 'aktif')->count();

        // Menghitung pendaftar yang status seleksinya masih 'pending'
        // Menggunakan whereRaw LOWER untuk memastikan teks aman dari perbedaan huruf kapital/kecil
        $count_baru = PendaftaranRelawan::whereRaw('LOWER(status_seleksi) = ?', ['pending'])->count();


        // 2. AMBIL DAFTAR KEGIATAN AKTIF (Limit 5)
        // Mengambil 5 kegiatan aktif terbaru untuk tabel daftar kegiatan
        $kegiatan = Kegiatan::where('status_kegiatan', 'aktif')
                            ->orderBy('id_kegiatan', 'desc')
                            ->limit(5)
                            ->get();


        // 3. AMBIL ANTRIAN PENDAFTAR BARU
        // Mengambil data pendaftaran yang pending + otomatis menarik data 'user' terkait (Eager Loading)
        $pendaftar = PendaftaranRelawan::with('user')
                        ->whereRaw('LOWER(status_seleksi) = ?', ['pending'])
                        ->orderBy('id_pendaftaran', 'desc')
                        ->get();

        // 4. KIRIM DATA KE VIEW BLADE
        // Data dikirim ke file resources/views/dashboard_admin.blade.php
        return view('admin.dashboard_admin', compact(
    'count_relawan',
    'count_program',
    'count_baru',
    'kegiatan',
    'pendaftar'
));
    }

    public function __construct()
    {
        // Perintah ini memastikan semua fungsi di controller ini harus lolos login dulu
        $this->middleware('auth');
    }
    
    // LOGIKA HAPUS KEGIATAN
    public function destroyKegiatan($id)
    {
        // Cari kegiatan berdasarkan ID, jika tidak ketemu langsung return error 404
        $kegiatan = Kegiatan::findOrFail($id);
        
        // Proses hapus data (karena di migration ada ON DELETE CASCADE, divisi terkait akan ikut terhapus otomatis)
        $kegiatan->delete();

        // Redirect kembali ke halaman dashboard dengan membawa flash message sukses
        return redirect()->route('admin.dashboard')->with('pesan', 'terhapus');
    }
}