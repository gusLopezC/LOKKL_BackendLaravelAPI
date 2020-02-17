<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitasToursCache extends Model
{
    //
    protected $fillable = [
        'id_tour',
        'user_id',
        'enviado'
    ];

    
    public function getTour()
    {
        return $this->hasMany('App\Tours', 'id', 'id_tour');
    }

    public function getUser()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}
