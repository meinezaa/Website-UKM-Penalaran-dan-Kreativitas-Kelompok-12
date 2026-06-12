<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Menggunakan Routing Controller bawaan inti Laravel
use Illuminate\Routing\Controller as BaseController; 
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Kegiatan;
use App\Models\PendaftaranRelawan;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDashboardController extends BaseController 
{
    public function index()
    {
        // 1. PROTEKSI MANUAL (Pengganti Middleware 'auth' bawaan yang kaku)
        // Memeriksa apakah session id_user ada dan tipenya adalah admin
        if (!session('id_user') || session('role') !== 'admin') {
            return redirect('/login')->withErrors(['login_error' => 'Akses ditolak! Sesi Anda berakhir atau Anda bukan Admin.']);
        }

        // 2. AMBIL STATISTIK DINAMIS
        // Menghitung total user yang rolenya 'user'
        $count_relawan = DB::table('pendaftaran_relawan')
                        ->where('status_seleksi', '=', 'Diterima') // Sesuaikan tulisan 'Diterima' dengan database-mu
                        ->count();

        // Menghitung kegiatan yang statusnya 'aktif'
        $count_program = Kegiatan::where('status_kegiatan', 'aktif')->count();

        // 3. Antrian Baru: Menghitung pendaftar yang statusnya masih 'Pending' atau 'Belum Diseleksi'
        $count_baru = DB::table('pendaftaran_relawan')
                        ->where('status_seleksi', '=', 'Pending') // Sesuaikan dengan status default saat mendaftar
                        ->count();

        // 3. AMBIL DAFTAR KEGIATAN AKTIF (Limit 5)
        $kegiatan = Kegiatan::where('status_kegiatan', 'aktif')
                            ->orderBy('id_kegiatan', 'desc')
                            ->limit(5)
                            ->get();


        // 4. AMBIL ANTRIAN PENDAFTAR BARU (Eager Loading)
        $pendaftar = PendaftaranRelawan::with('user')
                        ->whereRaw('LOWER(status_seleksi) = ?', ['pending'])
                        ->orderBy('id_pendaftaran', 'desc')
                        ->get();

        // 4. KIRIM DATA KE VIEW BLADE
return view('admin.dashboard_admin', compact(
    'count_relawan',
    'count_program',
    'count_baru',
    'kegiatan',
    'pendaftar'
));
    }

    
    // LOGIKA HAPUS KEGIATAN
    public function destroyKegiatan($id)
    {
        // Proteksi tambahan sebelum menghapus data
        if (!session('id_user') || session('role') !== 'admin') {
            return redirect('/login');
        }

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('admin.dashboard_admin')->with('pesan', 'Data kegiatan sukses dihapus!');
    }
}