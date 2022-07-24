<?php

namespace App\Handlers\Movies;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\DeleteMovieCandidateRequest;
use Throwable;
use App\Models\MovieCandidate;

Class DeleteMovieCandidateHandler
{
    public function handle(DeleteMovieCandidateRequest $request) : JsonResponse
    {
         try {
            $movieCandidateId = $request->get('id');
            MovieCandidate::where('id',$movieCandidateId)->delete();
            return new JsonResponse(['id' => $movieCandidateId], 200);
         } catch (Throwable $failure) {
            return new JsonResponse(['errorMessage' => $failure->getMessage()],500);
         }
    }
}
