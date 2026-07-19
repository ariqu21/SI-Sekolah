<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    protected $fillable=[
    'no_pendaftaran',
    'nama_lengkap',
    'tempat_lahir',
    'tanggal_lahir',
    'alamat',
    'nama_orangtua',
    'telepon',
    'jkelamin',
    'status'

    ];

    public function payments()
    {
        return $this->hasMany(
            Payment::class
        );
    }

    public function user()
    {
        return $this->hasOne(
            User::class
        );
    }
}

