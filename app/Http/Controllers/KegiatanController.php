<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\DivisiKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KegiatanController extends Controller
{
    /**
     * 1. MENAMPILKAN HALAMAN BERANDA PUBLIK Beserta Data Statistik
     */
    /**
     * 1. MENAMPILKAN HALAMAN BERANDA PUBLIK Beserta Data Statistik lengkap
     */
    public function beranda()
    {
        // Mengambil 3 kegiatan terbaru berstatus BUKA untuk ditampilkan di carousel/card
        $kegiatanTerbaru = Kegiatan::where('status_kegiatan', 'BUKA')
            ->orderBy('id_kegiatan', 'desc')
            ->take(3)
            ->get();

        // Menghitung total data untuk statistik halaman beranda
        $jumlahRelawan = DB::table('pendaftaran_relawan')->count();
        $jumlahSekolah = DB::table('mitra')->count(); 

        // HITUNG SISWA TERLIBAT: 
        // Opsi A: Jika kamu punya field target siswa di tabel kegiatan, kita jumlahkan totalnya
        // Opsi B: Jika belum ada tabelnya, kita set angka statis dulu (misal: 150) agar tidak error 500
        $jumlahSiswaTerlibat = 150; 

        // Jika di database kamu ingin menghitung dinamis dari total target kegiatan, aktifkan baris di bawah ini:
        // $jumlahSiswaTerlibat = DB::table('kegiatan')->sum('kuota_peserta_atau_siswa') ?? 0;

        // Kirim semua variabel yang dibutuhkan oleh resources/views/publik/beranda.blade.php
        return view('publik.beranda', compact('kegiatanTerbaru', 'jumlahRelawan', 'jumlahSekolah', 'jumlahSiswaTerlibat'));
    }

    /**
     * 2. MENAMPILKAN FORM EDIT KEGIATAN DI ADMIN
     */
    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $divisi = DivisiKegiatan::where('id_kegiatan', $id)->get();

        // =========================================================================
        // PERBAIKAN: Paksa $id menjadi Integer agar sinkron dengan tipe data DB
        // =========================================================================
        $idKegiatanAngka = (int) $id;

        $calonRelawan = DB::table('pendaftaran_relawan')
                            ->where('id_kegiatan', $idKegiatanAngka)
                            ->get();

        // Menyertakan variabel calonRelawan ke dalam compact() agar bisa dibaca file Blade
        return view('admin.edit_kegiatan', compact('kegiatan', 'divisi', 'calonRelawan'));
    }
    /**
 
     * 3. PROSES UPDATE DATA KEGIATAN DI ADMIN (PROSES EDIT)
     */
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto'), $namaFoto);
            $kegiatan->foto_kegiatan = $namaFoto;
        }

        // Mapping konversi tanggal dari input HTML ke nama kolom database asli
        $kegiatan->nama_kegiatan       = $request->nama_kegiatan;
        $kegiatan->kategori            = $request->kategori;
        $kegiatan->status_kegiatan     = $request->status_kegiatan;
        
        // Penyelarasan nama field HTML ke Database saat EDIT
        $kegiatan->tanggal_pelaksanaan = Carbon::parse($request->tanggal_pelaksanaan)->format('Y-m-d');
        $kegiatan->jam_kegiatan        = $request->jam_kegiatan;
        $kegiatan->pendaftaran_dibuka  = Carbon::parse($request->pembukaan_registrasi)->format('Y-m-d'); 
        $kegiatan->batas_registrasi    = Carbon::parse($request->batas_registrasi)->format('Y-m-d');
        
        // =========================================================================
        // TAMBAHKAN BARIS INI: Menangkap input "3. Hari Pengumuman" dari form HTML
        // =========================================================================
        $kegiatan->pengumuman_seleksi  = Carbon::parse($request->pengumuman_seleksi)->format('Y-m-d');
        
        $kegiatan->lokasi              = $request->lokasi;
        $kegiatan->alamat_lengkap      = $request->alamat_lengkap;
        $kegiatan->detail_aktivitas    = $request->detail_aktivitas;
        $kegiatan->deskripsi_detail    = $request->deskripsi_detail;
        $kegiatan->save();

        return redirect()->route('admin.kegiatan.index')->with('pesan', 'Data kegiatan berhasil diperbarui!');
    }

    /**
     * 4. MENAMPILKAN DAFTAR KEGIATAN DI HALAMAN ADMIN
     */
    public function kelolaKegiatan()
    {
        $kegiatan = Kegiatan::orderBy('id_kegiatan', 'desc')->get();
        return view('admin.kelola_kegiatan', compact('kegiatan')); 
    }

    /**
     * 5. MEMPROSES INPUT KEGIATAN BARU (PROSES TAMBAH)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'        => 'required|string|max:255',
            'foto_kegiatan'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kategori'             => 'required',
            'status_kegiatan'      => 'required',
            'tanggal_pelaksanaan'  => 'required',
            'jam_kegiatan'         => 'required',
            'pembukaan_registrasi' => 'required', // Menyesuaikan nama dari form HTML kamu
            'batas_registrasi'     => 'required', 
            'lokasi'               => 'required|string',
            'alamat_lengkap'       => 'required|string',
            'detail_aktivitas'     => 'required|string',
            'deskripsi_detail'     => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $namaFoto = null;
            if ($request->hasFile('foto_kegiatan')) {
                $file = $request->file('foto_kegiatan');
                $namaFoto = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('foto'), $namaFoto); 
            }

            // Simpan data menggunakan objek Model baru secara eksplisit
            $kegiatan = new Kegiatan();
            $kegiatan->id_user             = session('id_user') ?? 1;
            $kegiatan->nama_kegiatan       = $request->nama_kegiatan;
            $kegiatan->foto_kegiatan       = $namaFoto;
            $kegiatan->kategori            = $request->kategori;
            $kegiatan->status_kegiatan     = $request->status_kegiatan;
            
            // =========================================================================
            // FIX SINKRONISASI: Menghubungkan nama form HTML dengan field asli Database
            // =========================================================================
            $kegiatan->tanggal_pelaksanaan = Carbon::parse($request->tanggal_pelaksanaan)->format('Y-m-d');
            $kegiatan->jam_kegiatan        = $request->jam_kegiatan;
            $kegiatan->pendaftaran_dibuka  = Carbon::parse($request->pembukaan_registrasi)->format('Y-m-d'); // HTML 'pembukaan_registrasi' -> DB 'pendaftaran_dibuka'
            $kegiatan->batas_registrasi    = Carbon::parse($request->batas_registrasi)->format('Y-m-d');
            
            $kegiatan->lokasi              = $request->lokasi;
            $kegiatan->alamat_lengkap      = $request->alamat_lengkap;
            $kegiatan->detail_aktivitas    = $request->detail_aktivitas;
            $kegiatan->deskripsi_detail    = $request->deskripsi_detail;
            $kegiatan->save(); 

            $idKegiatanBaru = $kegiatan->id_kegiatan;

            $daftarDivisi = [
                'sekretaris'   => 'Sekretaris',
                'bendahara'    => 'Bendahara',
                'acara'        => 'Acara',        
                'humas'        => 'Humas',        
                'perkap'       => 'Perkap',       
                'pendamping'   => 'Pendamping',   
                'pdd'          => 'PDD',          
                'sponsorship'  => 'Sponsorship',  
            ];

            foreach ($daftarDivisi as $keyInput => $namaDivisiDb) {
                $kuotaInput   = $request->input("kuota_{$keyInput}");
                $jobdescInput = $request->input("jobdesc_{$keyInput}");

                if (!empty($kuotaInput) && $kuotaInput > 0) {
                    DivisiKegiatan::create([
                        'id_kegiatan' => $idKegiatanBaru,
                        'nama_divisi' => $namaDivisiDb,
                        'kuota'       => $kuotaInput,
                        'jobdesc'     => $jobdescInput ?? '-',
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.kegiatan.index')->with('pesan', 'Kegiatan baru dan kuota divisi berhasil diterbitkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}