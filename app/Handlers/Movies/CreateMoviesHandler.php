<?php

namespace App\Handlers\Movies;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\Movies\CreateMovieRequest;
use App\Models\MovieCandidate;
use App\Exceptions\FailedValidationException;
use Illuminate\Http\Client\Response;
use Throwable;
use Exception;
use Illuminate\Support\Facades\Http;

Class CreateMoviesHandler
{
    
    public function handle(CreateMovieRequest $request) : JsonResponse
    {
        try{
            $candidatesIds = $request->get('candidates_ids');
            $response = $this->sendCreateNewMoviesRequest($candidatesIds);
            $this->checkResponse($response);
            MovieCandidate::whereIn('id', $candidatesIds)->delete();
            return new JsonResponse(['success' => true, 'deletedCandidates' => $candidatesIds], 201);
        }
        catch(FailedValidationException $exception) {
            return new JsonResponse(['errors' => $exception->getErrorsList()], 400);
        }
        catch (Throwable $failure) {
            return new JsonResponse(['errorMessage' => $failure->getMessage()], 500);
        }
        
    }

    private function checkResponse(Response $response) : void 
    {
        switch($response->status()) {
        case 201:
            return;
            break;
            
        case 400:
            throw new FailedValidationException($response->json());
            break;

        case 500:
            throw new Exception('It was impossible to create movie because of empire server error');
            break;
        }
        
    }

    private function sendCreateNewMoviesRequest(array $candidatesIds) : Response
    {
        $empireMovieCreatorURL = config('empire.movie_creator_url');
        $empireAPIKey = config('empire.api_key');
        $movieCandidates = $this->getMovieCandidates($candidatesIds);
        return Http::withHeaders(
            [
            'Authorization' => $empireAPIKey,
            'Content-type' => 'application/json; charset=UTF-8'
            ]
        )->post($empireMovieCreatorURL, $movieCandidates);
    }

    private function parsePornstarsList(array $movieCandidates) : array
    {
        return array_map(function($candidate){
            if(isset($candidate['pornstars_list'])) {
                $candidate['pornstars_list'] = explode(',', $candidate['pornstars_list']);
            }
            return $candidate;
        }, $movieCandidates);
    }

    private function getMovieCandidates(array $candidatesIDs) : array
    {
        $movieCandidates = MovieCandidate::whereIn('id', $candidatesIDs)
                                         ->orderBy('id', 'asc')
                                         ->get()
                                         ->toArray();

        return $this->parsePornstarsList($movieCandidates);
    }

    
}