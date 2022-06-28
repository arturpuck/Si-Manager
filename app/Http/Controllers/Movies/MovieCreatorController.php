<?php

namespace App\Http\Controllers\Movies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Handlers\Movies\ShowMovieCreatorPanelHandler;
use App\Handlers\Movies\UpdateOrCreateMovieCandidateHandler;
use Illuminate\Http\JsonResponse;


class MovieCreatorController extends Controller
{
    public function showMovieCreatorPanel(ShowMovieCreatorPanelHandler $handler) : View {
        return $handler->handle();
    }

    public function showMovieSubmitPanel() : View {
        return view('movies.submit_panel');
    }

    public function addMovieCandidate(UpdateOrCreateMovieCandidateHandler $handler, Request $request) : JsonResponse {
       return $handler->handle($request);
    }

}
