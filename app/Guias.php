<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guias extends Model
{
    //
    protected $fillable = [
        'TipoGuia',
        'name',
        'email',
        'telefono',
        'edad',
        'ciudad',
        'document_identificacion',
        'document_comprobantedomicilio',
        'document_cedulafiscal',
        'document_certificacion',
        'user_id',

    ];

    public function getDatosPago()
    {
        return $this->hasMany('App\PaymentGuide', 'user_id');
    }
}
