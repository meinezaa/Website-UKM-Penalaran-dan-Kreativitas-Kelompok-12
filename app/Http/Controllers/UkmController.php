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
    /**
     * Halaman Publik Utama UKM
     * Mengambil semua komponen data UKM (Divisi, Visi Misi, BPH, Medsos)
     */
    public function index()
    {
        // 1. Ambil data Divisi
        $divisions = Division::get();

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
            'medsos'
        ));
    }

    /**
     * Halaman Publik Tim UKM
     */
public function Tim()
{
    // Mengambil data BPH dan membuang yang ada unsur Staf
    $bph_teams = Team::where('kategori', 'LIKE', '%BPH%')
                     ->where('kategori', 'NOT LIKE', '%Staf%')
                     ->get();
    
    // Mengambil data Staf Ahli
    $staf_teams = Team::where('kategori', 'LIKE', '%Staf%')->get();

    // Kirim kedua variabel ini ke view tim
    return view('layouts.tim', compact('bph_teams', 'staf_teams')); 
}
    /**
     * ------------------ KELOLA DROPDOWN TENTANG: HALAMAN UKM (ADMIN) ------------------
     * Menampilkan dashboard kelola data UKM untuk Admin
     */
    public function adminKelolaUkm()
    {
        if (!session('id_user') || session('role') !== 'admin') { 
            return redirect('/login'); 
        }
        
        // Ambil data menggunakan Model Eloquent (Sama persis seperti di index)
        $divisions = Division::get();
        $visis = VisionMission::where('type', 'visi')->get();
        $misis = VisionMission::where('type', 'misi')->get();
        $bph_ketua = Bph::where('role', 'Ketua Umum')->get();
        $bph_sekre = Bph::where('role', 'Sekretaris')->get();
        $bph_bendahara = Bph::where('role', 'Bendahara')->get();
        $medsos = Setting::pluck('value', 'key')->toArray();

        return view('admin.kelola_ukm', compact('divisions', 'visis', 'misis', 'bph_ketua', 'bph_sekre', 'bph_bendahara', 'medsos'));
    }

    /**
     * Route khusus untuk memproses update data dari modal admin
     */
    public function adminUpdateUkm(Request $request)
    {
        if (!session('id_user') || session('role') !== 'admin') { 
            return redirect('/login'); 
        }
        
        $target = $request->target_table;
        $id = $request->id;

        if ($target == 'visions_missions') {
            $item = VisionMission::find($id);
            if ($item) {
                $item->content = $request->content;
                $item->save();
            }
        } 
        
        elseif ($target == 'bph_members') {
            $item = Bph::find($id);
            if ($item) {
                $item->name = $request->name;
                $item->major_year = $request->major_year;
                
                // Proses upload foto jika admin mengganti foto
                if ($request->hasFile('photo')) {
                    $file = $request->file('photo');
                    $namaFoto = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('foto'), $namaFoto);
                    $item->photo = $namaFoto;
                }
                $item->save();
            }
        } 
        
        elseif ($target == 'divisions') {
            $item = Division::find($id);
            if ($item) {
                $item->name = $request->name;
                $item->description = $request->description;
                $item->save();
            }
        } 

        return redirect()->back()->with('pesan', 'Data komponen UKM berhasil diperbarui!');
    }
}