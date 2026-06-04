<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RelawanController extends Controller
{
    private function getKegiatan($kategori) {
        return DB::table('kegiatan')
            ->whereIn('kategori', [$kategori, strtolower($kategori)])
            ->orderByDesc('id_kegiatan')
            ->first();
    }

    public function index() {
        $sd = $this->getKegiatan('sd') ?? (object)['id_kegiatan' => 0, 'nama_kegiatan' => 'Program SD'];
        $slb = $this->getKegiatan('slb') ?? (object)['id_kegiatan' => 0, 'nama_kegiatan' => 'Program SLB'];
        $yayasan = $this->getKegiatan('yayasan') ?? (object)['id_kegiatan' => 0, 'nama_kegiatan' => 'Program Yayasan'];
        
        return view('relawan', compact('sd', 'slb', 'yayasan'));
    }

    public function sd() {
        $data = DB::table('kegiatan')
            ->whereIn('kategori', ['Sekolah Dasar', 'sd'])
            ->orderByDesc('id_kegiatan')->first();
        
        $divisi = $data ? DB::table('divisi_kegiatan')
            ->where('id_kegiatan', $data->id_kegiatan)
            ->where('kuota', '>', 0)->get() : collect();
        
        return view('relawan-sd', compact('data', 'divisi'));
    }

    public function slb() {
        $data = DB::table('kegiatan')
            ->whereIn('kategori', ['SLB', 'slb'])
            ->orderByDesc('id_kegiatan')->first();
        
        $divisi = $data ? DB::table('divisi_kegiatan')
            ->where('id_kegiatan', $data->id_kegiatan)
            ->where('kuota', '>', 0)->get() : collect();
        
        return view('relawan-slb', compact('data', 'divisi'));
    }

    public function yayasan() {
        $data = DB::table('kegiatan')
            ->whereIn('kategori', ['Yayasan', 'yayasan'])
            ->orderByDesc('id_kegiatan')->first();
        
        $divisi = $data ? DB::table('divisi_kegiatan')
            ->where('id_kegiatan', $data->id_kegiatan)
            ->where('kuota', '>', 0)->get() : collect();
        
        return view('relawan-yayasan', compact('data', 'divisi'));
    }
}