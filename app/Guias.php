<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guias extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'telefono',
        'edad',
        'ciudad',
        'idiomas',
        'pais',
        'tipomoneda',
        'clabeInterbancaria',
        'numeroCuenta',
        'RFC',
        'CURP',
        'document_identificacion',
        'document_comprobantedomicilio',
        'document_cedulafiscal',
        'document_certificacion',
        'document_CV',
        'user_id',

    ];
}
