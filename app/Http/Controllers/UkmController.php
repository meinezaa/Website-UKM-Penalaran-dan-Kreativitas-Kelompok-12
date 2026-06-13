<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Bph; 
use App\Models\VisionMission;
use App\Models\Setting;
use App\Models\Team; 

class UkmController extends Controller
{
    public function index()
    {
        // 1. Ambil data Divisi beserta relasi Program Kerjanya
        $divisions = Division::with('programs')->get();

        // 2. Ambil data Visi dan Misi
        $visis = VisionMission::where('type', 'visi')->get();
        $misis = VisionMission::where('type', 'misi')->get();

        // 3. Ambil data Badan Pengurus Harian (BPH) dari tabel database
        $bph_ketua = Bph::where('role', 'Ketua Umum')->get();
        $bph_sekre = Bph::where('role', 'LIKE', '%Sekretaris%')->get();
        $bph_bendahara = Bph::where('role', 'LIKE', '%Bendahara%')->get();

        // 4. Ambil data Settings Sosial Media
        $medsos = Setting::pluck('value', 'key')->toArray();

        // 5. Kirim SEMUA variabel sekaligus ke view 'layouts.ukm'
        return view('layouts.ukm', compact(
            'divisions', 
            'visis', 
            'misis', 
            'bph_ketua', 
            'bph_sekre', 
            'bph_bendahara', 
            'medsos',
        ));
    }

    public function Tim()
    {
        // PERBAIKAN 1: Menggunakan LIKE %BPH% untuk menghindari eror salah ketik/spasi di database
        $bph_teams = Team::where('kategori', 'LIKE', '%BPH%')->get();
        
        // PERBAIKAN 2: Menggunakan LIKE %Staf Ahli% agar data yang kelebihan spasi (seperti milik Inez) tetap sukses dipanggil
        $staf_teams = Team::where('kategori', 'LIKE', '%Staf Ahli%')->get();

        // 2. Kirim data ke file view layouts.tim
        return view('layouts.tim', compact('bph_teams', 'staf_teams')); 
    }
}