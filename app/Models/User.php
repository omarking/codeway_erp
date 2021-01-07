<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameUser',
        'firstLastname',
        'secondLastname',
        'phone',
        'name',
        'email',
        'corporative',
        'status',
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
        return $this->hasOne(Profile::class);
    }

    /* Un usuario tiene una posisición a travez de Profile(perfil) */
    public function position()
    {
        return $this->hasOneThrough(Position::class, Profile::class);
    }

    /* Un usuario tiene muchos comentarios */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /* Un usuario pertence a uno o muchos proyectos */
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }

    /* Un usuario pertence a uno o muchos departamentos */
    public function departaments()
    {
        return $this->belongsToMany(Departament::class)->withTimestamps();
    }

    /* Un usuario pertenece a uno o muchos roles */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /* Un usuario le pertencen una o muchas vaciones*/
    public function holidays()
    {
        return $this->belongsToMany(Holiday::class)->withTimestamps();
    }

    /* Un usuario realiza uno o muchos eventos */
    public function events()
    {
        return $this->belongsToMany(Event::class)->withTimestamps();
    }
}
