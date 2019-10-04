<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProspectosGuide extends Model
{
    protected $fillable = [

        'TipoProspecto',
        'nameContacto',
        'emailContacto',
        'telefonoContacto',
        'edad',
        'ciudad',
        'preguntasGuia',
        'comoNosConociste',
        'document_identificacion',
        'document_comprobantedomicilio',
        'document_cedulafiscal',
        'document_certificacion',
        'estado',
        // ====================
        'nameempresa',
        'nombreempresaLegal',
        'sitioweb',
        'DireccionCompletaEmpresa',
        'ContactoCompletoEmpresa',
        'user_id'


    ];
}
