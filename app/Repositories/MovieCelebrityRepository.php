<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Models\MovieCelebrity;

class MovieCelebrityRepository {

    private $movieCelebrityModel;

    public function __construct(MovieCelebrity $movieCelebrity)
    {
        $this->movieCelebrityModel = $movieCelebrity;
    }

    public function create($movieID, $celebrityID, $role = 'actor')
    {
        return $this->movieCelebrityModel->create([
            'movie_id' => $movieID, 
            'celebrity_id' => $celebrityID, 
            'role' => $role
        ]);
    }

    public function delete($movieID, $celebrityID, $role = 'actor')
    {
        $movieCelebrity = $this->movieCelebrityModel
            ->where('movie_id', $movieID)
            ->where('celebrity_id', $celebrityID)
            ->where('role', $role)
            ->first();

        if ($movieCelebrity->delete())
            return true;

        return false;
    }

    public function find($movieID, $celebrityID, $role = 'actor')
    {
        return $this->movieCelebrityModel
            ->where('movie_id', $movieID)
            ->where('celebrity_id', $celebrityID)
            ->where('role', $role)
            ->first();
    }

    public function checkIfProducerExist($movieID)
    {
        return $this->movieCelebrityModel
            ->where('movie_id', $movieID)
            ->where('role', 'producer')
            ->first();
    }
}