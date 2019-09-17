<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    //
    protected $fillable = [
    'comentario',
    'calificacion',
    'tour_id',
    'user_id',
    ];

    public function getTour()
    {
        return $this->belongsTo('App\Tours', 'id');
    }
    public function getUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
