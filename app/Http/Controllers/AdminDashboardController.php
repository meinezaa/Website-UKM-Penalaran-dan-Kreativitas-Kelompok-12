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
        if (!session('id_user') || session('role') !== 'admin') {
            return redirect('/login')->withErrors(['login_error' => 'Akses ditolak! Sesi Anda berakhir atau Anda bukan Admin.']);
        }

        // 2. AMBIL STATISTIK DINAMIS RELAWAN & PROGRAM
        $count_relawan = DB::table('pendaftaran_relawan')
                        ->where('status_seleksi', '=', 'Diterima') 
                        ->count();

        // =========================================================================
        // PERBAIKAN UTAMA: Menggunakan whereIn agar mencakup semua kemungkinan status aktif
        // =========================================================================
        $count_program = Kegiatan::whereIn('status_kegiatan', ['aktif', 'buka', 'BUKA'])->count();

        // Menghitung pendaftar yang statusnya masih 'Proses' atau 'Pending'
        $count_baru = DB::table('pendaftaran_relawan')
                        ->whereIn('status_seleksi', ['Pending', 'Proses']) 
                        ->count();

        // ==================== STATISTIK MITRA ====================
        $count_mitra = DB::table('mitra')->count();

        $count_mitra_baru = DB::table('mitra')
                        ->whereRaw('LOWER(status_mitra) = ?', ['pending'])
                        ->count();

        // 3. AMBIL DAFTAR KEGIATAN AKTIF (Limit 5)
        $programAktifCount = Kegiatan::whereIn('status_kegiatan', ['aktif', 'buka', 'BUKA'])->count();

        $kegiatan = Kegiatan::whereIn('status_kegiatan', ['aktif', 'buka', 'BUKA'])
                            ->orderBy('id_kegiatan', 'desc')
                            ->limit(5)
                            ->get();

        // 4. AMBIL ANTRIAN PENDAFTAR RELAWAN BARU (Eager Loading)
        $pendaftar = PendaftaranRelawan::with('user')
                        ->whereRaw('LOWER(status_seleksi) = ?', ['pending'])
                        ->orderBy('id_pendaftaran', 'desc')
                        ->get();

        // ==================== AMBIL ANTRIAN MITRA BARU ====================
        $mitra_baru = DB::table('mitra')
                        ->whereRaw('LOWER(status_mitra) = ?', ['pending'])
                        ->orderBy('id_mitra', 'desc') 
                        ->get();

        // ==================== ENGINE DATA GRAFIK BULANAN ====================
        $tahunIni = date('Y');
        
        $grafikRelawanRaw = DB::table('pendaftaran_relawan')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('count(*) as total'))
            ->whereYear('created_at', $tahunIni)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan')
            ->toArray();

        $grafikMitraRaw = DB::table('mitra')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('count(*) as total'))
            ->whereYear('created_at', $tahunIni)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan')
            ->toArray();

        $dataGrafikRelawan = [];
        $dataGrafikMitra   = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataGrafikRelawan[] = $grafikRelawanRaw[$i] ?? 0;
            $dataGrafikMitra[]   = $grafikMitraRaw[$i] ?? 0;
        }

        // 4. KIRIM DATA KE VIEW BLADE
        return view('admin.dashboard_admin', compact(
            'count_relawan',
            'count_program', // Variabel ini yang mengisi kotak Program Aktif
            'count_baru',
            'count_mitra',         
            'count_mitra_baru',    
            'kegiatan',
            'pendaftar',
            'mitra_baru',          
            'dataGrafikRelawan',   
            'dataGrafikMitra'      
        ));
    }

    
    // Ekspor data relawan ke excel (CSV) dengan validasi filter aktif
    public function eksporExcel(Request $request)
    {
        // 1. Inisialisasi query builder pendaftaran relawan lengkap dengan join tabel terkait
        $query = \DB::table('pendaftaran_relawan as p')
            ->join('users as u', 'p.id_user', '=', 'u.id_user')
            ->join('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan');

        // 2. LOGIKA FILTERING (Menyaring data ekspor sesuai pencarian aktif admin)
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('u.nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('p.asal_prodi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('divisi') && $request->divisi != 'semua') {
            $query->where(function($q) use ($request) {
                $q->where('p.pilihan_divisi_1', $request->divisi)
                  ->orWhere('p.pilihan_divisi_2', $request->divisi);
            });
        }

        // Ambil data hasil filter akhir
        $relawan = $query->select('u.nama_lengkap', 'u.email', 'p.no_hp', 'p.asal_prodi', 'k.nama_kegiatan', 'p.pilihan_divisi_1', 'p.status_seleksi')
            ->get();

        // 3. Tentukan nama file yang akan diunduh
        $namaFile = "Data_Relawan_UPN_Mengajar_" . date('Y-m-d') . ".csv";
        
        // 4. Atur Header HTTP agar browser langsung mendownload sebagai file Excel/CSV
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$namaFile",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // 5. Proses pembuatan baris data Excel secara instan tanpa library tambahan
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

    // Ekspor data relawan ke PDF dengan validasi filter aktif
    public function eksporPdf(Request $request)
    {
        // 1. Inisialisasi query builder dasar pendaftaran relawan
        $query = \DB::table('pendaftaran_relawan')
            ->join('users', 'pendaftaran_relawan.id_user', '=', 'users.id_user')
            ->join('kegiatan', 'pendaftaran_relawan.id_kegiatan', '=', 'kegiatan.id_kegiatan');

        // 2. LOGIKA FILTERING (Menyaring data cetak PDF sesuai pencarian aktif admin)
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('users.nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('pendaftaran_relawan.asal_prodi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('divisi') && $request->divisi != 'semua') {
            $query->where(function($q) use ($request) {
                $q->where('pendaftaran_relawan.pilihan_divisi_1', $request->divisi)
                  ->orWhere('pendaftaran_relawan.pilihan_divisi_2', $request->divisi);
            });
        }

        // Ambil data hasil filter akhir
        $dataRelawan = $query->select(
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