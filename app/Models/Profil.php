<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
    'nama_sekolah',
    'logo',
    'sejarah',
    'visi',
    'misi',
    'program',
    'alamat',
    'telepon',
    'email'
    ];
    
}