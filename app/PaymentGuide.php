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

    public function getDatosGuia()
    {
        return $this->hasMany('App\Guia', 'user_id');
    }
}
