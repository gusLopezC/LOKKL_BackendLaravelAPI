<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDatosPersonales extends Model
{
    //
    protected $fillable = [
        'NameContactoEmergencia',
        'NumContactoEmergencia',
        'EmailContactoEmergencia',
        'user_id'
    ];
}
