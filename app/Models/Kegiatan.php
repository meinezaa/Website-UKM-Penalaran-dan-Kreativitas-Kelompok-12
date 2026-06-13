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
        'nama_kegiatan',
        'foto_kegiatan',
        'tanggal_pelaksanaan',
        'jam_kegiatan',
        'batas_registrasi',
        'pendaftaran_dibuka', 
        'pengumuman_seleksi',  
        'lokasi',
        'alamat_lengkap',
        'kategori',
        'divisi_dibutuhkan',  
        'deskripsi_detail',
        'status_kegiatan',
        'detail_aktivitas',
    ];

    // 4. Tambahkan ini! Mengubah string tanggal dari DB otomatis menjadi Objek Date/Carbon
    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'batas_registrasi'    => 'date',
        'pendaftaran_dibuka'  => 'date',
        'pengumuman_seleksi'  => 'date',
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
        return $this->hasMany(DokumentasiKegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}