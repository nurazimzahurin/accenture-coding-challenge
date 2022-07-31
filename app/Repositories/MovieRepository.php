<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;

class MovieRepository {

    private $movieModel;

    public function __construct(Movie $movie)
    {
        $this->movieModel = $movie;
    }

    public function find($movieID)
    {
        return $this->movieModel->with(['actors', 'producer', 'media', 'celebrities'])
            ->where('id', $movieID)
            ->first();
    }

    public function get()
    {
        return $this->movieModel->with(['actors', 'producer', 'media'])
            ->orderByDesc('year_of_release')
            ->paginate(15);
    }

    public function create(FormRequest $requests)
    {
        $request = $requests->all();

        $movie = $this->movieModel->create([
            'name' => $request['name'], 
            'year_of_release' => $request['year_of_release'], 
            'plot' => $request['plot']
        ]);

        if (!isset($movie)) {
            return null;
        }

        $movie->addMedia($requests->file('poster'))
            ->toMediaCollection('poster');

        $movie->media;

        return $movie;
    }

    public function edit($movieID, FormRequest $requests)
    {
        $request = $requests->all();
        $movie = $this->find($movieID);

        if (!isset($movie))
            return false;

        $updatedMovie = $movie->update([
            'name' => $request['name'], 
            'year_of_release' => $request['year_of_release'], 
            'plot' => $request['plot']
        ]);

        if (!isset($updatedMovie))
            return false;
        
        if (isset($requests->poster)) {
            $movie->addMedia($requests->file('poster'))
                ->toMediaCollection('poster');
        }

        return true;
    }

    public function delete($movieID)
    {
        $movie = $this->find($movieID);
        
        if ($movie->members->each->delete() && $movie->delete())
            return true;

        return false;
    }
}