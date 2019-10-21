<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancelations extends Model
{
    //
    protected $fillable = [
        'id',
        'order_nr',
        'ModoPago',
        'Monto',
        'Moneda',
        'Fechareserva',
        'FechaCancelacion',
        'Estado',
        'Cancela',
        'motivoCancelacion',
        'NumTarjeta',
        'EstadoDinero',
        'id_payments',
        'id_tour',
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

    public function getTour()
    {
        return $this->hasMany('App\Tours', 'id', 'id_tour');
    }
}
