<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'holidays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'days',
        'beginDate',
        'endDate',
        'inProcess',
        'taken',
        'available',
        'commentable',
        'absence_id',
        'period_id',
    ];

    /* Una vación pertence a una ausencia */
    public function absence()
    {
        return $this->belongsTo(Absence::class);
    }

    /* Una vación pertenece a un perido */
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    /* Una vación pertenece a uno o muchos usuarios */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /* Una vación tiene muchos comentarios */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable'); //commentable_id y commentable_type
    }
}
