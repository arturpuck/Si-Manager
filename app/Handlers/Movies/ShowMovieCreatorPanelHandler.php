<?php

namespace App\Handlers\Movies;

use Illuminate\View\View;
use App\Models\Pornstar;

Class ShowMovieCreatorPanelHandler
{
    public function handle() : View
    {
        return view('movies.movie_candidate_creator');
    }
}