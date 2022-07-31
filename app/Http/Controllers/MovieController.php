<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\EditMovieRequest;
use App\Repositories\MovieRepository;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function find($movieID)
    {
        return $this->movieRepository->find($movieID);
    }

    public function get(Request $request)
    {
        $movies = $this->movieRepository->get();
        
        if (isset($request->message)) {
            return view('pages.movies')
                ->with('movies', $movies)
                ->with('message', $request->message);
        }

        if (isset($request->error)) {
            return view('pages.movies')
                ->with('movies', $movies)
                ->with('error', $request->error);
        }

        return view('pages.movies')
            ->with('movies', $movies);
    }

    public function create(CreateMovieRequest $createMovieRequest)
    {
        return $this->movieRepository->create($createMovieRequest);
    }

    public function edit($movieID, EditMovieRequest $editMovieRequest)
    {
        return $this->movieRepository->edit($movieID, $editMovieRequest);
    }

    public function delete($movieID)
    {
        $deleted = $this->movieRepository->delete($movieID);

        if ($deleted)
            return redirect()->route('movie-list', ['message' => 'Movie deleted successfully.']);

        return redirect()->route('movie-list', ['error' => 'Movie delete unsuccessful.']);
    }
}
