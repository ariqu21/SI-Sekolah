<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [

        'registrasi_id',
        'order_id',
        'total',
        'payment_proof',
        'verification_status'

    ];

    public function registrasi()
    {
        return $this->belongsTo(
            Registrasi::class
        );
    }
}
