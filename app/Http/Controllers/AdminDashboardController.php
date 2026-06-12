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

        // 5. KIRIM DATA KE VIEW BLADE
        // REVISI: Mengembalikan ke 'admin.dashboard_admin' agar sinkron dengan struktur file view admin kamu
        return view('admin.dashboard_admin', compact(
            'count_relawan', 
            'count_program', 
            'count_baru', 
            'kegiatan', 
            'pendaftar'
        ));
    }

    // Ekspor data relawan ke excel (CSV)
    public function eksporExcel()
{
    // 1. Ambil data relawan lengkap dari database
    $relawan = \DB::table('pendaftaran_relawan as p')
        ->join('users as u', 'p.id_user', '=', 'u.id_user')
        ->join('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
        ->select('u.nama_lengkap', 'u.email', 'p.no_hp', 'p.asal_prodi', 'k.nama_kegiatan', 'p.pilihan_divisi_1', 'p.status_seleksi')
        ->get();

    // 2. Tentukan nama file yang akan diunduh
    $namaFile = "Data_Relawan_UPN_Mengajar_" . date('Y-m-d') . ".csv";
    
    // 3. Atur Header HTTP agar browser langsung mendownload sebagai file Excel/CSV
    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$namaFile",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    // 4. Proses pembuatan baris data Excel secara instan tanpa library tambahan
    $callback = function() use($relawan) {
        $file = fopen('php://output', 'w');
        
        // Tulis Judul Kolom paling atas di Excel
        fputcsv($file, ['Nama Lengkap', 'Email', 'No HP', 'Asal Prodi', 'Nama Kegiatan', 'Divisi', 'Status Seleksi']);

        // Masukkan data relawan baris demi baris
        foreach ($relawan as $row) {
            fputcsv($file, [
                $row->nama_lengkap,
                $row->email,
                $row->no_hp,
                $row->asal_prodi,
                $row->nama_kegiatan,
                $row->pilihan_divisi_1,
                $row->status_seleksi
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

// Ekspor data relawan ke PDF
public function eksporPdf()
{
    // Ambil data relawan yang terdaftar
    $dataRelawan = \DB::table('pendaftaran_relawan')
        ->join('users', 'pendaftaran_relawan.id_user', '=', 'users.id_user')
        ->join('kegiatan', 'pendaftaran_relawan.id_kegiatan', '=', 'kegiatan.id_kegiatan')
        ->select(
            'users.nama_lengkap', 
            'users.email', 
            'pendaftaran_relawan.no_hp', 
            'pendaftaran_relawan.asal_prodi', 
            'kegiatan.nama_kegiatan', 
            'pendaftaran_relawan.pilihan_divisi_1', 
            'pendaftaran_relawan.status_seleksi'
        )->get();

    // Kirim data ke file cetak blade khusus PDF
    $pdf = Pdf::loadView('admin.cetak_pdf', compact('dataRelawan'));

    // Mengatur kertas ke ukuran A4 landscape agar tabel muat dengan rapi
    $pdf->setPaper('a4', 'landscape');

    // Unduh otomatis file PDF-nya
    return $pdf->download('Laporan_Data_Relawan_' . date('Y-m-d') . '.pdf');
}

    // REVISI UTAMA: Fungsi __construct() dengan middleware('auth') DIHAPUS TOTAL 
    // karena sudah digantikan oleh sistem cek session manual di dalam fungsi index() di atas.

    // 6. LOGIKA HAPUS KEGIATAN
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