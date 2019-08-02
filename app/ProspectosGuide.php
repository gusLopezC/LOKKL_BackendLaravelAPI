<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProspectosGuide extends Model
{
    protected $fillable = [
        'name', 'email', 'edad', 'telefono','ciudad', 'eres_guia', 'trabajas_como_guia',
        'certificacion_guia', 'idiomas', 
        'certificacion_idiomas', 'comonosconociste','user_id'
    ];
}
