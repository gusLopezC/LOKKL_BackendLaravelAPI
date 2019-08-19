<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guias extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'telefono',
        'edad',
        'ciudad',
        'idiomas',
        'numeroCuenta',
        'user_id'

    ];
}
