<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    // 1. Tentukan nama tabel asli di database
    protected $table = 'kegiatan';

    // 2. Tentukan kustomisasi Primary Key
    protected $primaryKey = 'id_kegiatan';

    // 3. Daftarkan kolom yang bisa diisi massal lewat form / controller
    protected $fillable = [
        'id_user',
        'foto_kegiatan',
        'nama_kegiatan',
        'kategori',
        'tanggal_pelaksanaan',
        'jam_kegiatan',
        'batas_registrasi',
        'lokasi',
        'alamat_lengkap',
        'detail_aktivitas',
        'deskripsi_detail',
        'status_kegiatan',
    ];

    /**
     * RELASI ANTAR TABEL (Eloquent Relationships)
     */

    // Relasi ke tabel PendaftaranRelawan (Satu kegiatan bisa memiliki banyak pendaftar)
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranRelawan::class, 'id_kegiatan', 'id_kegiatan');
    }

    // Relasi ke tabel DivisiKegiatan (Satu kegiatan memiliki banyak divisi kepanitiaan)
    public function divisi()
    {
        return $this->hasMany(DivisiKegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }

    // Relasi balik ke User (Pembuat kegiatan / Admin yang bertanggung jawab)
    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    // Relasi ke tabel dokumentasi_kegiatan
public function dokumentasi()
{
    return $this->hasMany(
        DokumentasiKegiatan::class,
        'id_kegiatan',
        'id_kegiatan'
    );
}
}
