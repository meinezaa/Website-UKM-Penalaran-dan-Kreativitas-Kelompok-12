<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team; // Menggunakan nama model asli Anda
use Illuminate\Support\Facades\File;

class TimController extends Controller
{
    // Menampilkan halaman kelola tim di sisi admin
    public function index()
    {
        $tim = Team::orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->get();
        return view('admin.kelola_tim', compact('tim'));
    }

    // Memproses simpan anggota baru
    public function store(Request $request)
    {
        // 1. Validasi data diperlonggar agar tidak memicu muatan server macet
        $request->validate([
            'nama'     => 'required|string|max:255',
            'jabatan'  => 'required|string|max:255',
            'kategori' => 'required|string', 
            'foto'     => 'nullable|image|max:10240', // Diubah ke 10MB agar jepretan kamera HP asli langsung lolos
            'urutan'   => 'nullable|integer',
        ]);

        // 2. Pemrosesan file foto dengan nama enkripsi acak yang aman
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            // Menggunakan kombinasi waktu dan ID unik agar nama file bersih total dari spasi/karakter aneh
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file ke folder public/foto_tim
            $file->move(public_path('foto_tim'), $namaFoto);
        }

        // 3. Simpan data ke database menggunakan Model Team
        Team::create([
            'nama'      => $request->nama,
            'jabatan'   => $request->jabatan,
            'kategori'  => $request->kategori, 
            'foto'      => $namaFoto,
            'instagram' => $request->instagram,
            'email'     => $request->email,
            'linkedin'  => $request->linkedin,
            'urutan'    => $request->urutan ?? 0,
        ]);

        // 4. Redirect kembali menggunakan URL absolut internal
        return redirect('/admin/kelola-tim')->with('pesan', 'Anggota tim baru berhasil ditambahkan!');
    }

    // Memproses edit data anggota tim
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'jabatan'  => 'required|string|max:255',
            'kategori' => 'required|string',
            'foto'     => 'nullable|image|max:10240',
            'urutan'   => 'nullable|integer',
        ]);

        $anggota = Team::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama dari penyimpanan jika file tersebut ada
            if ($anggota->foto && File::exists(public_path('foto_tim/' . $anggota->foto))) {
                File::delete(public_path('foto_tim/' . $anggota->foto));
            }

            $file = $request->file('foto');
            
            // Amankan penamaan file edit baru
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto_tim'), $namaFoto);
            
            $anggota->foto = $namaFoto;
        }

        $anggota->nama      = $request->nama;
        $anggota->jabatan   = $request->jabatan;
        $anggota->kategori  = $request->kategori;
        $anggota->instagram = $request->instagram;
        $anggota->email     = $request->email;
        $anggota->linkedin  = $request->linkedin;
        $anggota->urutan    = $request->urutan ?? 0;
        $anggota->save();

        return redirect('/admin/kelola-tim')->with('pesan', 'Data anggota tim berhasil diperbarui!');
    }
    
    // Menghapus anggota tim
    public function destroy($id)
    {
        $anggota = Team::findOrFail($id);
        
        if ($anggota->foto && File::exists(public_path('foto_tim/' . $anggota->foto))) {
            File::delete(public_path('foto_tim/' . $anggota->foto));
        }

        $anggota->delete();
        return redirect('/admin/kelola-tim')->with('pesan', 'Anggota tim berhasil dihapus!');
    }
}