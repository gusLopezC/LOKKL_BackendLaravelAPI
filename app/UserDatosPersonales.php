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
        'ParentescoEmergencia',
        'user_id'
    ];
}
