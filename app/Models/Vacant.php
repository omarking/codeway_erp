<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
    ];

    /* Una vacante pertence a uno o muchos preusuarios */
    public function preusers()
    {
        return $this->belongsToMany(Preuser::class)->withTimestamps();
    }
}