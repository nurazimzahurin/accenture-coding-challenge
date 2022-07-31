<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieCelebrityRequest;
use App\Http\Requests\DeleteMovieCelebrityRequest;
use App\Repositories\CelebrityRepository;
use App\Repositories\MovieCelebrityRepository;
use App\Repositories\MovieRepository;

class MovieCelebrityController extends Controller
{
    private $movieCelebrityRepository, $movieRepository, $celebrityRepository;

    public function __construct(MovieCelebrityRepository $movieCelebrityRepository, MovieRepository $movieRepository, CelebrityRepository $celebrityRepository)
    {
        $this->movieCelebrityRepository = $movieCelebrityRepository;
        $this->movieRepository = $movieRepository;
        $this->celebrityRepository = $celebrityRepository;
    }

    public function create(CreateMovieCelebrityRequest $createMovieCelebrityRequest)
    {
        $movieID = $this->movieRepository->find($createMovieCelebrityRequest->movie_id)->id;
        $celebrityID = $this->celebrityRepository->find($createMovieCelebrityRequest->celebrity_id)->id;

        $movieCelebrity = $this->movieCelebrityRepository->create($movieID, $celebrityID, $createMovieCelebrityRequest->role);

        $movie = $movieCelebrity->movie;
        $movie->actors;
        $movie->producer;
        $movie->media;

        return $movie;
    }

    public function delete(DeleteMovieCelebrityRequest $deleteMovieCelebrityRequest)
    {
        $movieID = $this->movieRepository->find($deleteMovieCelebrityRequest->movie_id)->id;
        $celebrityID = $this->celebrityRepository->find($deleteMovieCelebrityRequest->celebrity_id)->id;

        return $this->movieCelebrityRepository->delete($movieID, $celebrityID, $deleteMovieCelebrityRequest->role);
    }
}
