<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranRelawan extends Model
{
    use HasFactory;

    // 1. Tentukan nama tabel secara eksplisit karena tidak menggunakan format jamak default (plural) Laravel
    protected $table = 'pendaftaran_relawan';

    // 2. Tentukan Primary Key yang kamu gunakan di tabel ini
    protected $primaryKey = 'id_pendaftaran';

    // 3. Daftarkan kolom yang boleh diisi (Mass Assignment) sesuai migration kamu
    protected $fillable = [
        'id_user',
        'id_kegiatan',
        'no_hp',
        'umur',
        'jenis_kelamin',
        'asal_prodi',
        'pilihan_divisi_1',
        'pilihan_divisi_2',
        'portofolio',
        'pengalaman_keahlian',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status_seleksi',
    ];

    /**
     * RELASI ANTAR TABEL (Eloquent Relationships)
     */

    // Relasi balik ke model User (Setiap pendaftaran dimiliki oleh 1 User/Relawan)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi balik ke model Kegiatan (Setiap pendaftaran merujuk pada 1 Kegiatan)
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }

    public function down(): void
{
    Schema::dropIfExists('pendaftaran_relawan'); // Hapus huruf 's' di belakangnya
}

}