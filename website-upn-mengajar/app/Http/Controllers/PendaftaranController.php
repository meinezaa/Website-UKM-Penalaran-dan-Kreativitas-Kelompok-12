<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function form(Request $request) {
        $user = DB::table('users')->where('id_user', session('id_user'))->first();
        $id_kegiatan = $request->get('id_kegiatan');
        return view('formulir', compact('user', 'id_kegiatan'));
    }

    public function store(Request $request) {
        $file = $request->file('bukti_pembayaran');
        $filename = 'BUKTI_' . time() . '_' . session('id_user') . '.' . $file->extension();
        $file->storeAs('uploads', $filename, 'public');

        DB::table('pendaftaran_relawan')->insert([
            'id_user'            => session('id_user'),
            'id_kegiatan'        => $request->id_kegiatan,
            'no_hp'              => $request->no_hp,
            'umur'               => $request->umur,
            'jenis_kelamin'      => $request->jenis_kelamin,
            'asal_prodi'         => $request->asal_prodi,
            'pilihan_divisi_1'   => $request->pilihan_divisi_1,
            'pilihan_divisi_2'   => $request->pilihan_divisi_2,
            'portofolio'         => $request->portofolio,
            'pengalaman_keahlian'=> $request->deskripsi,
            'metode_pembayaran'  => $request->metode_pembayaran,
            'bukti_pembayaran'   => $filename,
        ]);

        return redirect('/status-pendaftaran');
    }

    public function status() {
        $data = DB::table('pendaftaran_relawan as p')
            ->join('users as u', 'p.id_user', '=', 'u.id_user')
            ->leftJoin('kegiatan as k', 'p.id_kegiatan', '=', 'k.id_kegiatan')
            ->where('p.id_user', session('id_user'))
            ->orderByDesc('p.id_pendaftaran')
            ->first();
        
        return view('status-pendaftaran', compact('data'));
    }
}