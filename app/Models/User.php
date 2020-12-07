<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Funcion que obtiene la imagen de perfil de un usuario */
    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    /* Funcion que obtiene el rol de un usuario */
    public function adminlte_desc()
    {
        return 'Administrador';
    }

    /* Función que obtiene la ruta del perfil de un usuario */
    public function adminlte_profile_url()
    {
        return 'profile/username';
    }

    /* Un usuario tiene un solo perfil */
    public function profile()
    {
        return $this->hasOne('');
    }
}
