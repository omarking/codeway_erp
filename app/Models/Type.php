<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'status',
    ];

    /* Un tipo(type) tiene muchas tareas(task) */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
