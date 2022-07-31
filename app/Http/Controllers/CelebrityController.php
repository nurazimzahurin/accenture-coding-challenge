<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCelebrityRequest;
use App\Repositories\CelebrityRepository;
use App\Repositories\MovieCelebrityRepository;
use App\Repositories\MovieRepository;

class CelebrityController extends Controller
{
    private $celebrityRepository, $movieCelebrityRepository, $movieRepository;

    public function __construct(CelebrityRepository $celebrityRepository, MovieCelebrityRepository $movieCelebrityRepository, MovieRepository $movieRepository)
    {
        $this->celebrityRepository = $celebrityRepository;
        $this->movieCelebrityRepository = $movieCelebrityRepository;
        $this->movieRepository = $movieRepository;
    }

    public function create(CreateCelebrityRequest $createCelebrityRequest)
    {
        $celebrity = $this->celebrityRepository->create($createCelebrityRequest->all());
        $movie = $this->movieRepository->find($createCelebrityRequest->movie_id);

        if (isset($celebrity)) {
            $movieCelebrity = $this->movieCelebrityRepository->create($movie->id, $celebrity->id, $createCelebrityRequest->role);

            if (isset($movieCelebrity)) {
                $movie = $movieCelebrity->movie;
                $movie->actors;
                $movie->producer;
            }
        }

        return $movie;
    }

    public function getCelebrities()
    {
        return $this->celebrityRepository->get();
    }
}
