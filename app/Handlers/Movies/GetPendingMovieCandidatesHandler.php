<?php

namespace App\Handlers\Movies;

use Illuminate\Http\JsonResponse;
use App\Models\MovieCandidate;

Class GetPendingMovieCandidatesHandler
{
    public function handle() : JsonResponse
    {
        $movieCandidates = MovieCandidate::orderBy('id')->get();
        return response()->json($movieCandidates, 200);
    }
}