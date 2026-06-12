<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// PENTING: Pastikan semua Model ini di-import di bagian atas!
use App\Models\Division;
use App\Models\Bph;
use App\Models\VisionMission;
use App\Models\Setting;

class UkmController extends Controller
{
    public function index()
    {
        // 1. Ambil data Divisi beserta relasi Program Kerjanya
        $divisions = Division::with('programs')->get();

        // 2. Ambil data Visi dan Misi secara terpisah berdasarkan tipe
        $visis = VisionMission::where('type', 'visi')->get();
        $misis = VisionMission::where('type', 'misi')->get();

        // 3. Ambil data pengurus BPH berdasarkan Jabatan/Role
        $bph_ketua     = Bph::where('role', 'Ketua Umum')->get();
        $bph_sekre     = Bph::where('role', 'Sekretaris')->get();
        $bph_bendahara = Bph::where('role', 'Bendahara')->get();

        // 4. Ambil data Settings (Sosial Media) dan ubah menjadi bentuk Array [key => value]
        $medsos = Setting::pluck('value', 'key')->toArray();

        // 5. Kirim SEMUA variabel ke file ukm.blade.php
        return view('layouts.ukm', compact(
            'divisions', 
            'visis', 
            'misis', 
            'bph_ketua', 
            'bph_sekre', 
            'bph_bendahara', 
            'medsos'
        ));
    }
}