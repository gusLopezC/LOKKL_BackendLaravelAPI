<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToursEspañol extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'cuidad',
        'categories',
        'schedulle',
        'duration',
        'override',
        'whatsIncluded',
        'itinerary',
        'mapaGoogle',
        'puntoInicio',
        'calification',
        'lenguajes',
        'price',
        'user_guide'
    ];

  
}
