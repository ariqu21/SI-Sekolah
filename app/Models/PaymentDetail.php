<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $fillable = [
        'payment_id',
        'payment_type_id',
        'nominal'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
