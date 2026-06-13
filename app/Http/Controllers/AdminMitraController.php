<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMitraController extends Controller
{
    // Menampilkan halaman daftar mitra di admin
    public function index()
    {
        $mitra = DB::table('mitra')->get();
        return view('admin.mitra.index', compact('mitra'));
    }

    // Fungsi SAKTI: Ini yang bertugas mengubah status jadi DISETUJUI di database
    public function setujui($id)
{
    DB::beginTransaction();

    try {

        DB::table('mitra')
            ->where('id_mitra', $id)
            ->update([
                'status_mitra' => 'DISETUJUI'
            ]);

        DB::commit();

        return back()->with(
            'success',
            'Status mitra berhasil disetujui!'
        );

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with(
            'error',
            'Terjadi kesalahan saat memperbarui status mitra.'
        );
    }
}
}