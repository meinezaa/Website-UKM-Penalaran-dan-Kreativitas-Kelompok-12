<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Menggunakan DB Facade agar tidak perlu ribet setting Model Eloquent

class UpnMengajarController extends Controller
{
    /**
     * Menampilkan halaman form kelola konten di Dashboard Admin
     */
    public function index()
    {
        // Validasi Session Keamanan Admin
        if (!session('id_user') || session('role') !== 'admin') { 
            return redirect('/login'); 
        }
        
        // Mengambil baris pertama dari tabel upnmengajar_settings
        $profil = DB::table('upnmengajar_settings')->first();
        
        return view('admin.kelola_upnmengajar', compact('profil'));
    }

    /**
     * Memproses data inputan baru atau pembaruan (Update) dari form admin
     */
    public function update(Request $request)
    {
        // Validasi Session Keamanan Admin
        if (!session('id_user') || session('role') !== 'admin') { 
            return redirect('/login'); 
        }

        // Cek apakah sudah ada data awal di tabel
        $first = DB::table('upnmengajar_settings')->first();
        
        // Memetakan data dari input 'name' form blade ke kolom database baru
        $dataUpdate = [
            'sub_judul'        => $request->sub_judul,
            'judul_hero'       => $request->judul_hero,
            'deskripsi_hero'   => $request->deskripsi_hero,
            'sdgs_text'        => $request->sdgs_text,
            'metodologi_text'  => $request->metodologi_text,
            'quotes'           => $request->quotes,
            'updated_at'       => now()
        ];

        if ($first) {
            // Jika data sudah ada, lakukan UPDATE berdasarkan primary key: id_setting
            DB::table('upnmengajar_settings')
                ->where('id_setting', $first->id_setting)
                ->update($dataUpdate);
        } else {
            // Jika tabel masih kosong (pertama kali input), lakukan INSERT data baru
            $dataUpdate['created_at'] = now();
            DB::table('upnmengajar_settings')->insert($dataUpdate);
        }
        
        return redirect()->back()->with('pesan', 'Seluruh komponen halaman UPN Mengajar berhasil diperbarui!');
    }
}