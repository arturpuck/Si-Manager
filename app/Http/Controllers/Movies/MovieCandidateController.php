<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DeleteMovieCandidateRequest;
use App\Handlers\Movies\ShowMovieCreatorPanelHandler;
use App\Handlers\Movies\UpdateOrCreateMovieCandidateHandler;
use App\Handlers\Movies\GetPendingMovieCandidatesHandler;
use App\Handlers\Movies\DeleteMovieCandidateHandler;


class MovieCandidateController extends Controller
{
    public function showMovieCreatorPanel(ShowMovieCreatorPanelHandler $handler) : View {
        return $handler->handle();
    }

    public function addOrEditMovieCandidate(UpdateOrCreateMovieCandidateHandler $handler) : JsonResponse {
       return $handler->handle();
    }

    public function getPendingMovieCandidates(GetPendingMovieCandidatesHandler $handler) : JsonResponse
    {
        return $handler->handle();
    }

    public function deleteMovieCandidate(DeleteMovieCandidateHandler $handler, DeleteMovieCandidateRequest $request) : JsonResponse
    {
       return $handler->handle($request);
    }

}
