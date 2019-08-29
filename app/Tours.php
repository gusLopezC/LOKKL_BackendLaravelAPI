<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'slug',
        'cuidad',
        'categories',
        'schedulle',
        'duration',
        'overview',
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
  public function getPhotos()
    {
        return $this->hasMany('App\PhotosTours', 'tour_id');
    }
  

  
}
