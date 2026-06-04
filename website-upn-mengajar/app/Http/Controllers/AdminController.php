<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard() {
        $countRelawan = DB::table('users')->where('role', 'user')->count();
        $countProgram = DB::table('kegiatan')->where('status_kegiatan', 'aktif')->count();
        $countBaru    = DB::table('pendaftaran_relawan')->whereRaw("LOWER(status_seleksi) = 'pending'")->count();
        $kegiatan     = DB::table('kegiatan')->where('status_kegiatan', 'aktif')->orderByDesc('id_kegiatan')->limit(5)->get();
        $pendaftar    = DB::table('pendaftaran_relawan as p')
            ->join('users as u', 'p.id_user', '=', 'u.id_user')
            ->whereRaw("LOWER(p.status_seleksi) = 'pending'")
            ->orderByDesc('p.id_pendaftaran')
            ->select('p.*', 'u.nama_lengkap')
            ->get();

        return view('admin.dashboard', compact('countRelawan', 'countProgram', 'countBaru', 'kegiatan', 'pendaftar'));
    }

    public function relawan(Request $request) {
        $search = $request->get('search', '');
        $divisi = $request->get('divisi', 'semua');

        $query = DB::table('pendaftaran_relawan as p')
            ->join('users as u', 'p.id_user', '=', 'u.id_user')
            ->select('p.*', 'u.nama_lengkap', 'u.email');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('u.nama_lengkap', 'LIKE', "%$search%")
                  ->orWhere('p.asal_prodi', 'LIKE', "%$search%");
            });
        }

        if ($divisi !== 'semua') {
            $query->where('p.pilihan_divisi_1', $divisi);
        }

        $relawan = $query->orderByDesc('p.id_pendaftaran')->get();
        return view('admin.relawan', compact('relawan', 'search', 'divisi'));
    }

    public function hapusRelawan($id) {
        if ($id != session('id_user')) {
            DB::table('users')->where('id_user', $id)->delete();
        }
        return redirect()->route('admin.relawan')->with('success', 'Relawan berhasil dihapus.');
    }

    public function kegiatan() {
        $kegiatan = DB::table('kegiatan')->get();
        return view('admin.kegiatan', compact('kegiatan'));
    }

    public function tambahKegiatan() {
        return view('admin.tambah-kegiatan');
    }

    public function simpanKegiatan(Request $request) {
        $fotoName = 'default.jpg';
        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $fotoName = date('YmdHis') . '_' . $file->getClientOriginalName();
            $file->storeAs('foto', $fotoName, 'public');
        }

        $id = DB::table('kegiatan')->insertGetId([
            'id_user'          => session('id_user'),
            'foto_kegiatan'    => $fotoName,
            'nama_kegiatan'    => $request->nama_kegiatan,
            'kategori'         => $request->kategori,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'jam_kegiatan'     => $request->jam_kegiatan,
            'batas_registrasi' => $request->batas_registrasi,
            'lokasi'           => $request->lokasi,
            'alamat_lengkap'   => $request->alamat_lengkap,
            'detail_aktivitas' => $request->detail_aktivitas,
            'deskripsi_detail' => $request->deskripsi_detail,
            'status_kegiatan'  => $request->status_kegiatan,
        ]);

        $divisis = ['sekretaris'=>'Sekretaris','bendahara'=>'Bendahara','acara'=>'Acara','humas'=>'Humas','perkap'=>'Perkap','pendamping'=>'Pendamping Kelompok','pdd'=>'PDD','sponsorship'=>'Sponsorship'];
        foreach ($divisis as $key => $label) {
            $kuota = (int)($request->input("kuota_$key") ?? 0);
            if ($kuota > 0) {
                DB::table('divisi_kegiatan')->insert([
                    'id_kegiatan' => $id,
                    'nama_divisi' => $label,
                    'kuota'       => $kuota,
                    'jobdesc'     => $request->input("jobdesc_$key"),
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function editKegiatan($id) {
        $data = DB::table('kegiatan')->where('id_kegiatan', $id)->first();
        return view('admin.edit-kegiatan', compact('data'));
    }

    public function updateKegiatan(Request $request, $id) {
        DB::table('kegiatan')->where('id_kegiatan', $id)->update([
            'nama_kegiatan'       => $request->nama_kegiatan,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'lokasi'              => $request->lokasi,
            'status_kegiatan'     => $request->status_kegiatan,
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function hapusKegiatan($id) {
        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function exportExcel() {
        // Implementasi dengan Maatwebsite Excel
        // return Excel::download(new RelawanExport, 'relawan.xlsx');
    }
}