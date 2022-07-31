<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celebrity extends Model
{
    use HasFactory;

    protected $keyType = 'integer';

    protected $fillable = [
        'name', 
        'sex', 
        'dob',
        'bio',
        'created_at', 
        'updated_at'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_celebrities', 'celebrity_id', 'movie_id');
    }

    public function acting()
    {
        return $this->belongsToMany(Movie::class, 'movie_celebrities', 'celebrity_id', 'movie_id')
            ->wherePivot('role', 'actor');
    }

    public function producing()
    {
        return $this->belongsToMany(Movie::class, 'movie_celebrities', 'celebrity_id', 'movie_id')
            ->wherePivot('role', 'producer');
    }
}
