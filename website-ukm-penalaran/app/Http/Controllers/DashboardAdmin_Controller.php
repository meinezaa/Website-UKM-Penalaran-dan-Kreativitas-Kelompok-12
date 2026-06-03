<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Halaman Utama Dashboard Admin
     * Menampilkan statistik dinamis, info kegiatan aktif, dan antrian pendaftar.
     */
    public function index()
    {
        // 1. Ambil Data Statistik Dinamis
        $count_relawan = DB::table('users')->where('role', 'user')->count();
        $count_program = DB::table('kegiatan')->where('status_kegiatan', 'aktif')->count();
        $count_baru = DB::table('pendaftaran_relawan')->whereRaw('LOWER(status_seleksi) = ?', ['pending'])->count();

        // 2. Ambil Daftar Kegiatan Aktif (Limit 5)
        $kegiatan_aktif = DB::table('kegiatan')
                            ->where('status_kegiatan', 'aktif')
                            ->orderBy('id_kegiatan', 'desc')
                            ->limit(5)
                            ->get();

        // 3. Ambil Antrian Pendaftar Baru
        $antrian_pendaftar = DB::table('pendaftaran_relawan as p')
                                ->join('users as u', 'p.id_user', '=', 'u.id_user')
                                ->select('p.id_pendaftaran', 'u.nama_lengkap', 'p.asal_prodi', 'p.status_seleksi')
                                ->whereRaw('LOWER(p.status_seleksi) = ?', ['pending'])
                                ->orderBy('p.id_pendaftaran', 'desc')
                                ->get();

        // Lempar variabel ke view blade admin
        return view('admin.dashboard', compact('count_relawan', 'count_program', 'count_baru', 'kegiatan_aktif', 'antrian_pendaftar'));
    }

    /**
     * Halaman Kelola Kegiatan: Data Kegiatan
     * Menampilkan seluruh daftar agenda kegiatan tanpa batasan limit.
     */
    public function kegiatan()
    {
        // Query mengambil semua data dari tabel kegiatan
        $query_kegiatan = DB::table('kegiatan')->get();

        // Mengirimkan variabel ke view data_kegiatan admin
        return view('admin.data_kegiatan', compact('query_kegiatan'));
    }

    /**
     * Menampilkan Halaman Form Tambah Kegiatan
     */
    public function tambahKegiatan()
    {
        return view('admin.kegiatan_tambah');
    }

    /**
     * Memproses Penyimpanan Data Transaksi Kegiatan Baru dan Divisi Terkait
     */
    public function simpanKegiatan(Request $request)
    {
        // 1. Validasi Input Dasar Form Laravel
        $request->validate([
            'nama_kegiatan'        => 'required|string',
            'foto_kegiatan'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kategori'             => 'required',
            'status_kegiatan'      => 'required',
            'tanggal_pelaksanaan'  => 'required|date',
            'jam_kegiatan'         => 'required|string',
            'batas_registrasi'     => 'required|date',
            'lokasi'               => 'required|string',
            'alamat_lengkap'       => 'required|string',
            'detail_aktivitas'     => 'required|string',
            'deskripsi_detail'     => 'required|string',
        ]);

        // 2. Pemrosesan Upload File Gambar Utama
        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $namaFotoBaru = date('YmdHis') . "_" . $file->getClientOriginalName();
            
            // Memindahkan gambar ke dalam direktori public/foto/ sesuai arsitektur native Anda
            $file->move(public_path('foto'), $namaFotoBaru);
        } else {
            $namaFotoBaru = "default.jpg";
        }

        // 3. Jalankan Database Transaction Safe Guarding
        DB::beginTransaction();

        try {
            // Simpan Data Induk ke Tabel 'kegiatan'
            $idKegiatanBaru = DB::table('kegiatan')->insertGetId([
                'id_user'             => Auth::id(), // Mengambil ID admin yang sedang aktif log-in
                'foto_kegiatan'       => $namaFotoBaru,
                'nama_kegiatan'       => $request->nama_kegiatan,
                'kategori'            => $request->kategori,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'jam_kegiatan'        => $request->jam_kegiatan,
                'batas_registrasi'    => $request->batas_registrasi,
                'lokasi'              => $request->lokasi,
                'alamat_lengkap'      => $request->alamat_lengkap,
                'detail_aktivitas'    => $request->detail_aktivitas,
                'deskripsi_detail'    => $request->deskripsi_detail,
                'status_kegiatan'     => $request->status_kegiatan,
            ]);

            // Mapping List Divisi Kerja
            $divisiList = [
                'sekretaris' => 'Sekretaris', 'bendahara' => 'Bendahara', 
                'acara'      => 'Acara',      'humas'      => 'Humas', 
                'perkap'     => 'Perkap',     'pendamping' => 'Pendamping Kelompok', 
                'pdd'        => 'PDD',        'sponsorship'=> 'Sponsorship'
            ];

            // Loop and Insert Child Row Ke Tabel 'divisi_kegiatan'
            foreach ($divisiList as $key => $label) {
                $kuotaInput = $request->input('kuota_' . $key);
                $kuota = !empty($kuotaInput) ? (int)$kuotaInput : 0;
                $jobdesc = $request->input('jobdesc_' . $key) ?? '';

                if ($kuota > 0) {
                    DB::table('divisi_kegiatan')->insert([
                        'id_kegiatan' => $idKegiatanBaru,
                        'nama_divisi' => $label,
                        'kuota'       => $kuota,
                        'jobdesc'     => $jobdesc
                    ]);
                }
            }

            // Jika semua query berhasil, kunci perubahan data ke MySQL
            DB::commit();

            // Kembali dengan status sukses untuk ditangkap SweetAlert2 di View Blade
            return back()->with('status_sukses', 'Kegiatan berhasil ditambahkan.');

        } catch (\Exception $e) {
            // Jika salah satu query gagal, gagalkan semua insert data agar tidak korup
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Logika Aksi: Hapus Kegiatan Secara Permanen
     * Digunakan baik di halaman Dashboard maupun di halaman Kelola Kegiatan.
     */
    public function hapusKegiatan($id, Request $request)
    {
        // REVISI SAFE-GUARDING: Hapus data baris anak di divisi_kegiatan terlebih dahulu
        // untuk mengantisipasi database yang belum diset ON DELETE CASCADE.
        DB::table('divisi_kegiatan')->where('id_kegiatan', $id)->delete();

        // Setelah aman, baru hapus data induk kegiatannya
        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        
        // Cek jika request menghapus datang dari halaman kelola kegiatan, maka redirect ke sana
        if ($request->segment(2) === 'kegiatan') {
            return redirect()->route('admin.kegiatan')->with('pesan', 'terhapus');
        }
        
        // Default redirect kembali ke halaman utama dashboard
        return redirect()->route('admin.dashboard')->with('pesan', 'terhapus');
    }

    /**
     * Logika Aksi: Arsipkan Kegiatan (Ubah status menjadi diarsipkan)
     */
    public function arsipKegiatan($id)
    {
        DB::table('kegiatan')->where('id_kegiatan', $id)->update(['status_kegiatan' => 'diarsipkan']);
        return redirect()->route('admin.dashboard')->with('pesan', 'diarsipkan');
    }

    /**
     * Logika Aksi: Terima Calon Relawan Baru
     */
    public function terimaRelawan($id)
    {
        DB::table('pendaftaran_relawan')->where('id_pendaftaran', $id)->update(['status_seleksi' => 'Diterima']);
        return redirect()->route('admin.dashboard')->with('pesan', 'relawan_diterima');
    }

    /**
     * Halaman Manajemen Relawan
     * Menangani pemuatan data dengan fitur pencarian nama/prodi dan filter divisi.
     */
    public function relawan(Request $request)
    {
        $search = $request->input('search');
        $filter_divisi = $request->input('divisi', 'semua');

        // Memulai query builder dasar (Base Query)
        $query = DB::table('pendaftaran_relawan as p')
            ->join('users as u', 'p.id_user', '=', 'u.id_user')
            ->select('p.*', 'u.nama_lengkap', 'u.email');

        // Logika Pencarian
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('u.nama_lengkap', 'LIKE', '%' . $search . '%')
                  ->orWhere('p.asal_prodi', 'LIKE', '%' . $search . '%');
            });
        }

        // Logika Filter Divisi
        if ($filter_divisi !== 'semua') {
            $query->where('p.pilihan_divisi_1', $filter_divisi);
        }

        // Urutkan berdasarkan pendaftaran terbaru
        $query_relawan = $query->orderBy('p.id_pendaftaran', 'desc')->get();

        return view('admin.data_relawan', compact('query_relawan'));
    }

    /**
     * Logika Aksi: Hapus Akun Relawan (Berdasarkan ID User)
     */
    public function hapusRelawan($id)
    {
        // Validasi Satpam: Mencegah Admin menghapus akun dirinya sendiri yang sedang login
        if ($id == Auth::id()) {
            return redirect()->route('admin.relawan')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Melakukan penghapusan data pada tabel users
        DB::table('users')->where('id_user', $id)->delete();

        return redirect()->route('admin.relawan')->with('pesan', 'terhapus');
    }

    /**
     * Menampilkan Form Edit Kegiatan
     * Menggantikan logika penarikan data $_GET['id'] lama
     */
    public function editKegiatan($id)
    {
        // Cari data kegiatan berdasarkan id_kegiatan
        $data = DB::table('kegiatan')->where('id_kegiatan', $id)->first();

        // Jika data tidak ditemukan, balikkan ke halaman kelola kegiatan dengan alert error flash data
        if (!$data) {
            return redirect()->route('admin.kegiatan')->with('error', 'Data tidak ditemukan!');
        }

        return view('admin.edit_kegiatan', compact('data'));
    }

    /**
     * Memproses Simpan Perubahan Data Kegiatan (Logika Update)
     */
    public function updateKegiatan(Request $request, $id)
    {
        // 1. Validasi Input Form (Sesuai validasi frontend)
        $request->validate([
            'nama_kegiatan'       => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'lokasi'              => 'required|string|max:255',
            'status_kegiatan'     => 'required|in:aktif,selesai',
        ]);

        // 2. Eksekusi Query Update menggunakan Query Builder Laravel (Otomatis kebal SQL Injection)
        DB::table('kegiatan')
            ->where('id_kegiatan', $id)
            ->update([
                'nama_kegiatan'       => $request->nama_kegiatan,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'lokasi'              => $request->lokasi,
                'status_kegiatan'     => $request->status_kegiatan,
            ]);

        // 3. Redirect kembali ke halaman kelola kegiatan setelah berhasil
        return redirect()->route('admin.kegiatan')->with('pesan', 'diperbarui');
    }
}