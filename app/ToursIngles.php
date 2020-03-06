<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ToursIngles extends Model
{

    use Sluggable;

    //
    protected $fillable = [
        'id',

        'cuidad',
        'pais',
        'placeID',
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
        'lenguaje',

        'user_guide',
        'user_id'
    ];
    public function getPhotos()
    {
        return $this->hasMany('App\PhotosTours', 'tour_id');
    }

    public function getUser()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
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

