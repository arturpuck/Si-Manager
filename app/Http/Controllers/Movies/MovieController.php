<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Handlers\Movies\CreateMoviesHandler;
use App\Http\Requests\Movies\CreateMovieRequest;


class MovieController extends Controller
{
    public function showMovieCreationPanel() : View 
    {
        return view('movies.movie_creator');
    }
    
    public function createMovies(CreateMovieRequest $request, CreateMoviesHandler $handler) : JsonResponse
    {
       return $handler->handle($request);
    }
}
