<?php

namespace App\Http\Controllers\Movies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Handlers\Movies\ShowMovieCreatorPanelHandler;
use App\Handlers\Movies\UpdateOrCreateMovieCandidateHandler;
use Illuminate\Http\JsonResponse;
use App\Handlers\Movies\GetPendingMovieCandidatesHandler;


class MovieCandidateController extends Controller
{
    public function showMovieCreatorPanel(ShowMovieCreatorPanelHandler $handler) : View {
        return $handler->handle();
    }

    public function showMovieSubmitPanel() : View {
        return view('movies.submit_panel');
    }

    public function addOrEditMovieCandidate(UpdateOrCreateMovieCandidateHandler $handler, Request $request) : JsonResponse {
       return $handler->handle($request);
    }

    public function getPendingMovieCandidates(GetPendingMovieCandidatesHandler $handler) : JsonResponse
    {
        return $handler->handle();
    }

}
