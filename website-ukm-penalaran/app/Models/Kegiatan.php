<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    public $timestamps = false; // Karena di SQL-mu tidak ada kolom created_at/updated_at

    protected $fillable = [
        'id_user', 'nama_kegiatan', 'foto_kegiatan', 'tanggal_pelaksanaan',
        'jam_kegiatan', 'batas_registrasi', 'lokasi', 'alamat_lengkap',
        'kategori', 'deskripsi_detail', 'status_kegiatan', 'detail_aktivitas'
    ];
}