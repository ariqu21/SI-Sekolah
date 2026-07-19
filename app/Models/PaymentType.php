<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = [

    'nama',
    'nominal',
    'deskripsi'

    ];

    public function payments()
    {
        return $this->hasMany(
            Payment::class
        );
    }
}
