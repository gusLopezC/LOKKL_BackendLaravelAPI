<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MensajesChat extends Model
{
    //
    protected $fillable = [
        'id',
        'mensaje',
        'escribio',
        'id_reservacion',
        'id_comprador',
        'id_guia'

    ];

    public function getComprador()
    {
        return $this->hasMany('App\User', 'id', 'id_comprador');
    }
    public function getGuia()
    {
        return $this->hasMany('App\User', 'id', 'id_guia');
    }
}
