<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
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

    /* Un periodo tiene muchas vacaciones */
    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }
}