<?php

namespace App\Handlers\Movies;

use Illuminate\View\View;
use App\Models\Pornstar;

Class ShowMovieCreatorPanelHandler
{
    public function handle() : View
    {
        $pornstarsNames = Pornstar::pluck('nickname')->toArray();
        return view('movies.movie_creator')->with([
            'pornstarsNames' => $pornstarsNames
        ]);
    }
}