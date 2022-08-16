<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'ambil_kegiatan_id',
        'target_realisasi',
        'kerjasama',
        'ketepatan_waktu',
        'kualitas',
    ];
}
