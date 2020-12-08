<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preuser extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'preusers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'email',
        'status',
    ];

    /* Un preuser realiza una o muchas vacantes */
    public function vacants()
    {
        return $this->belongsToMany(Vacant::class)->withTimestamps();
    }
}
