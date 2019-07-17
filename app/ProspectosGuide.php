<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProspectosGuide extends Model
{
    protected $fillable = [
        'name', 'email', 'edad', 'cuidad_origin', 'eres_guia', 'trabajas_como_guia',
        'certificacion_guia', 'idiomas_quemanejas', 
        'certificacion_idiomas', 'como_nos_conociste','user_id'
    ];
}
