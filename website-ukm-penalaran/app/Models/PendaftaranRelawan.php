<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranRelawan extends Model
{
    protected $table = 'pendaftaran_relawan';
    protected $primaryKey = 'id_pendaftaran';
    public $timestamps = false;

    protected $fillable = [
        'id_user', 'id_kegiatan', 'no_hp', 'umur', 'jenis_kelamin',
        'asal_prodi', 'pilihan_divisi_1', 'pilihan_divisi_2', 'portofolio',
        'pengalaman_keahlian', 'metode_pembayaran', 'bukti_pembayaran', 'status_seleksi'
    ];
}