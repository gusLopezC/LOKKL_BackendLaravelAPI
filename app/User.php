<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const USUARIO_VERIFICADO = true;


    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'img', 'infopersonal', 'telephone',
        'verified', 'verification_token', 'role', 'sexo', 'archivovalidacion', 'notificaciones'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password', 'remember_token', 'verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function esVerificado()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    public static function generarToken()
    {
        return str_random(40);
    }
    public function getAvatarUrl()
    {
        if ($this->photo_extension)
            return asset('images/users/' . $this->id . '.' . $this->photo_extension);

        return asset('images/users/default.jpg');
    }
}
