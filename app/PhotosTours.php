<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotosTours extends Model
{

    protected $fillable = [
        'photo',
        'tour_id',
    ];

    public function getTour()
    {
        return $this->belongsTo('App\Tours', 'id');
    }
}
