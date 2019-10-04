<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGuide extends Model
{
    //
    protected $fillable = [
        'pais',
        'tipomoneda',
        'clabeInterbancaria',
        'numeroCuenta',
        'RFC',
        'CURP',
        'user_id',
    ];
}
