<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'description',
        'birthday',
        'facebook',
        'instagram',
        'github',
        'website',
        'other',
        'user_id',
    ];

    /* Un profile pertence a un usuario */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /* Un perfil tiene una posición */
    public function position()
    {
        return $this->hasOne(Position::class);
    }
}
