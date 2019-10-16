<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    //
    protected $fillable = [
        'id',
        'order_nr',
        'ModoPago',
        'IdPago',
        'DatosComprador',
        'NameTour',

        'Monto',
        'Moneda',
        'Fechareserva',
        'CantidadTuristas',
        'status',

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
}
