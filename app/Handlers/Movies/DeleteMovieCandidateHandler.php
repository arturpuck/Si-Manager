<?php

namespace App\Handlers\Movies;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\Movies\MovieCandidateRangeRequest;
use Throwable;
use App\Models\MovieCandidate;

Class DeleteMovieCandidateHandler
{
    public function handle(MovieCandidateRangeRequest $request) : JsonResponse
    {
        try {
            $movieCandidateRange = $request->get('id');
            return $this->tryToDeleteMovieCandidates($movieCandidateRange);
        } catch (Throwable $failure) {
            return new JsonResponse(['errorMessage' => $failure->getMessage()], 500);
        }
    }

    public function tryToDeleteMovieCandidates($range) : JsonResponse
    {
        switch(true) {
        case $range === 'all':
            $range = MovieCandidate::pluck('id')->toArray();
            MovieCandidate::whereIn('id', $range)->delete();
            break;

        default:
            MovieCandidate::where('id', $range)->delete();
            break;
        }

        return new JsonResponse(['id' => $range], 200);
    }
}
