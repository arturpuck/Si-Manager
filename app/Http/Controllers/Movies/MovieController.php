<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use Illuminate\View\View;


class MovieController extends Controller
{
    public function showMovieCreationPanel() : View 
    {
        return view('movies.movie_creator');
    } 
}
