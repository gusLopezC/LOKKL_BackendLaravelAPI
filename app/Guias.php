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
        'clabeInterbancaria',
        'numeroCuenta',
        'RFC',
        'CURP',
        'user_id',

    ];
}
