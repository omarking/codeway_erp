<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'full-access',
        'status',
        'responsable',
    ];

    /* Un rol pertence a uno o muchos usuarios */
    public function roles()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /* Un rol pertenece a uno a muchos permisos */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
}
