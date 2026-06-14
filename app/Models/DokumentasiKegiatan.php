<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    protected $table = 'dokumentasi_kegiatan';

    protected $primaryKey = 'id_dokumentasi';

    public $timestamps = false;

    protected $fillable = [
        'id_kegiatan',
        'judul_foto',
        'foto',
        'deskripsi'
    ];

    /**
     * [TAMBAHAN] Otomatis mengubah string koma di DB menjadi Array PHP saat dipanggil.
     * Begitu juga sebaliknya saat melakukan insert/update data.
     */
    protected $casts = [
        'foto' => 'array',
    ];

    // Relasi ke kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(
            Kegiatan::class,
            'id_kegiatan',
            'id_kegiatan'
        );
    }
}