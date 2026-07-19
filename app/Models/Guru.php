<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable=[

    'nama_lengkap',
    'jkelamin',
    'tempat_lahir',
    'tanggal_lahir',
    'NUPTK',
    'NIK',
    'pendidikan',
    'alamat',

    ];
}
