// PASTIKAN MODUL-MODUL INI SUDAH DI-IMPORT DI BAGIAN ATAS FILE web.php YA!
use App\Models\Division;
use App\Models\Bph;
use App\Models\VisionMission;
use App\Models\Setting;

// ... kode route lainnya ...

// ------------------ KELOLA DROPDOWN TENTANG: HALAMAN UKM ------------------
Route::get('/admin/kelola-ukm', function () {
    if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
    
    // Ambil data menggunakan Model Eloquent (Sama persis seperti di UkmController)
    $divisions = Division::get();
    $visis = VisionMission::where('type', 'visi')->get();
    $misis = VisionMission::where('type', 'misi')->get();
    $bph_ketua = Bph::where('role', 'Ketua Umum')->get();
    $bph_sekre = Bph::where('role', 'Sekretaris')->get();
    $bph_bendahara = Bph::where('role', 'Bendahara')->get();
    $medsos = Setting::pluck('value', 'key')->toArray();

    return view('admin.kelola_ukm', compact('divisions', 'visis', 'misis', 'bph_ketua', 'bph_sekre', 'bph_bendahara', 'medsos'));
})->name('admin.kelola_ukm');

// Route khusus untuk memproses update data dari modal admin
Route::post('/admin/kelola-ukm/update', function (Request $request) {
    if (!session('id_user') || session('role') !== 'admin') { return redirect('/login'); }
    
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
})->name('admin.kelola_ukm.update');