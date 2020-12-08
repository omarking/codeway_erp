<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'name',
        'description',
        'status',
        'responsable',
        'clas_id',
    ];

    /* Un proyecto pertence a una clase */
    public function clas()
    {
        return $this->belongsTo(Clas::class);
    }

    /* Un proyecto pertenece a una o muchas tareas */
    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }

    /* Un proyecto pertenece a uno o muchos usuarios */
    public function users()
    {
        return $this->belongsToMany(Users::class)->withTimestamps();
    }

    /* Un proyecto tiene muchos comentarios */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable'); //commentable_id y commentable_type
    }
}
