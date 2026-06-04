<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisiKegiatan extends Model
{
    use HasFactory;

    // 1. Tentukan nama tabel asli di database
    protected $table = 'divisi_kegiatan';

    // 2. Tentukan kustomisasi Primary Key
    protected $primaryKey = 'id_divisi_kegiatan';

    // 3. Daftarkan kolom yang bisa diisi massal (Mass Assignment)
    protected $fillable = [
        'id_kegiatan',
        'nama_divisi',
        'kuota',
        'jobdesc',
    ];

    /**
     * RELASI ANTAR TABEL (Eloquent Relationships)
     */

    // Relasi balik ke model Kegiatan (Setiap divisi merujuk/dimiliki oleh 1 Kegiatan)
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}