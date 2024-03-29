<?php

namespace App\Handlers\Movies;

use Illuminate\Http\JsonResponse;
use App\CustomValidators\MoviePropertiesValidator;
use App\Models\MovieCandidate;
use Throwable;
use App\Models\Nationality;
use App\Models\Location;
use App\Models\StoryOrCostumeType;
use App\Http\Exceptions\FailedValidationException;


Class UpdateOrCreateMovieCandidateHandler
{

private int $successFullResponseCode;
private array $validatedData;

const RELATIONAL_PROPERTIES = [
    'actress_nationality', 
    'location', 
    'story_or_costume_type', 
    'pornstars_list'
];

public function handle() : JsonResponse
{
    try {
        $this->initiateValidation();
        $this->getValidatedMovieProperties();
        $movieId = $this->validatedData['id'] ?? null;
        $movieCandidate = MovieCandidate::firstOrNew(['id' => $movieId]);
        $this->assignSimpleValues($movieCandidate);
        $this->assignValuesForColumnsContainingForeignKeys($movieCandidate);
        $this->assignPornstarsList($movieCandidate);
        $movieCandidate->save();
        return new JsonResponse($movieCandidate, $this->successFullResponseCode);
    } catch (FailedValidationException $failedValidation) {
        return new JsonResponse(['errors' => $failedValidation->getErrors()], 400);
    }
    catch (Throwable $failure) {
        return new JsonResponse(['errorMessage' => $failure->getMessage()], 500);
    }
}

private function initiateValidation() : void
{
    if(request()->isMethod('PUT')) {
        MoviePropertiesValidator::$checkMovieID = true;
        $this->successFullResponseCode = 200;
    } else {
        $this->successFullResponseCode = 201;
    }
}

private function getValidatedMovieProperties() : void
{
    $this->validatedData = MoviePropertiesValidator::validate(request());
}

protected function assignValuesForColumnsContainingForeignKeys(MovieCandidate $movieCandidate) : void
{
       
    if(array_key_exists('actress_nationality', $this->validatedData)) {
        $nationality = Nationality::where(['name' => $this->validatedData['actress_nationality']])->get()->first();
        $movieCandidate->actressNationality()->associate($nationality);
    }

    if(array_key_exists('location', $this->validatedData)) {
        $location = Location::where(['name' => $this->validatedData['location']])->get()->first();
        $movieCandidate->location()->associate($location);
    }

    if(array_key_exists('story_or_costume_type', $this->validatedData)) {
        $story_or_costume_typeType = StoryOrCostumeType::where(['name' => $this->validatedData['story_or_costume_type']])->get()->first();
        $movieCandidate->storyOrCostumeType()->associate($story_or_costume_typeType);
    }

}

protected function assignPornstarsList(MovieCandidate $movieCandidate) : void
{
    if(array_key_exists('pornstars_list', $this->validatedData)) {
        $movieCandidate->pornstars_list = implode(',', $this->validatedData['pornstars_list']);
    } 
}

protected function assignSimpleValues(MovieCandidate $movieCandidate) : void
{
    $simpleValues = array_diff_key($this->validatedData, array_flip(self::RELATIONAL_PROPERTIES));
    foreach($simpleValues as $propertyName => $value) {
       $movieCandidate->$propertyName = $value;
    }
}
}