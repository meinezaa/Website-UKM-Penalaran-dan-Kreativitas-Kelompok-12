<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpnMengajarSetting extends Model
{
    use HasFactory;

    // Mengenalkan nama tabel custom ke Eloquent
    protected $table = 'upnmengajar_settings';

    // Mengenalkan nama primary key yang memiliki identitas khusus
    protected $primaryKey = 'id_setting';

    // Daftarkan kolom yang boleh diisi massal oleh form
    protected $fillable = [
        'sub_judul',
        'judul_hero',
        'deskripsi_hero',
        'sdgs_text',
        'metodologi_text',
        'quotes'
    ];
}