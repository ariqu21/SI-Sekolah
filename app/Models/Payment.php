<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [

    'registrasi_id',
    'payment_type_id',
    'tanggal_bayar',
    'nominal',
    'status',
    'metode',
    'keterangan',
    'order_id',
    'transaction_id',
    'snap_token',
    'paid_at',

    'payment_proof',
    'verification_status'

    ];

    protected $casts = [

    'tanggal_bayar' => 'datetime',
    'paid_at' => 'datetime',

    ];

    public function registrasi()
    {
        return $this->belongsTo(
            Registrasi::class
        );
    }

    public function paymentType()
    {
        return $this->belongsTo(
            PaymentType::class
        );
    }

    public function details()
    {
        return $this->hasMany(
            PaymentDetail::class
        );
    }
}

