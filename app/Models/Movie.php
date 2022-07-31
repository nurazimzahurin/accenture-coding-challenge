<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Movie extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $keyType = 'integer';

    protected $fillable = [
        'name', 
        'year_of_release', 
        'plot',
        'created_at', 
        'updated_at',
        'deleted_at'
    ];

    public function celebrities()
    {
        return $this->belongsToMany(Celebrity::class, 'movie_celebrities', 'movie_id', 'celebrity_id');
    }

    public function actors()
    {
        return $this->belongsToMany(Celebrity::class, 'movie_celebrities', 'movie_id', 'celebrity_id')
            ->wherePivot('role', 'actor');
    }

    public function producer()
    {
        return $this->belongsToMany(Celebrity::class, 'movie_celebrities', 'movie_id', 'celebrity_id')
            ->wherePivot('role', 'producer');
    }

    public function members()
    {
        return $this->hasMany(MovieCelebrity::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('poster')
            ->singleFile();
    }
}
