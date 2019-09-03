<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    //
    protected $fillable = [
        'id',

        'cuidad',
        'pais',
        'CP',

        'name',
        'slug',

        'mapaGoogle',
        'puntoInicio',

        'schedulle',
        'overview',

        'itinerary',
        'whatsIncluded',

        'categories',        
        'duration',
        'calification',
        'lenguajes',
        'price',
        'user_guide',
        'user_id'
    ];
  public function getPhotos()
    {
        return $this->hasMany('App\PhotosTours', 'tour_id');
    }
  

  
}
