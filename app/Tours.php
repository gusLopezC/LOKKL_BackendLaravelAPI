<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{

    use Sluggable;

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
 

        'itinerary',
        'whatsIncluded',

        'categories',        
        'duration',
        'calification',
        'lenguajes',
        'price',
        'priceFinal',
        'moneda',
        
        'user_guide',
        'user_id'
    ];
  public function getPhotos()
    {
        return $this->hasMany('App\PhotosTours', 'tour_id');
    }

        /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
  

  
}
