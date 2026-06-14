<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team; // Menggunakan nama model asli kamu
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
        $request->validate([
            'nama'     => 'required|string|max:255',
            'jabatan'  => 'required|string|max:255',
            'kategori' => 'required|string|in:bph,staf_ahli', // Validasi tipe kategori database kamu
            'foto'     => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan'   => 'nullable|integer',
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_tim'), $namaFoto);
        }

        Team::create([
            'nama'      => $request->nama,
            'jabatan'   => $request->jabatan,
            'kategori'  => $request->kategori, // Menyimpan nilai 'bph' atau 'staf_ahli'
            'foto'      => $namaFoto,
            'instagram' => $request->instagram,
            'email'     => $request->email,
            'linkedin'  => $request->linkedin,
            'urutan'    => $request->urutan ?? 0,
        ]);

        return redirect()->back()->with('pesan', 'Anggota tim baru berhasil ditambahkan!');
    }

    // Memproses edit data anggota tim
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'jabatan'  => 'required|string|max:255',
            'kategori' => 'required|string|in:bph,staf_ahli',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan'   => 'nullable|integer',
        ]);

        $anggota = Team::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($anggota->foto && File::exists(public_path('foto_tim/' . $anggota->foto))) {
                File::delete(public_path('foto_tim/' . $anggota->foto));
            }

            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
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

        return redirect()->back()->with('pesan', 'Data anggota tim berhasil diperbarui!');
    }

    // Menghapus anggota tim
    public function destroy($id)
    {
        $anggota = Team::findOrFail($id);
        
        if ($anggota->foto && File::exists(public_path('foto_tim/' . $anggota->foto))) {
            File::delete(public_path('foto_tim/' . $anggota->foto));
        }

        $anggota->delete();
        return redirect()->back()->with('pesan', 'Anggota tim berhasil dihapus!');
    }
}