<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovieCelebrity extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'integer';

    protected $fillable = [
        'movie_id', 
        'celebrity_id', 
        'role',
        'created_at', 
        'updated_at',
        'deleted_at'
    ];

    public function celebrity()
    {
        return $this->belongsTo(Celebrity::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
