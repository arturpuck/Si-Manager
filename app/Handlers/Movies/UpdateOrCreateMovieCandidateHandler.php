<?php

namespace App\Handlers\Movies;

use Illuminate\Http\JsonResponse;
use App\CustomValidators\MoviePropertiesValidator;
use Illuminate\Http\Request;
use App\Models\MovieCandidate;
use Throwable;
use App\Models\Nationality;
use App\Models\Location;
use App\Models\StoryOrCostumeType;


Class UpdateOrCreateMovieCandidateHandler
{

    public const MAP_PROPERTY_NAME_TO_COLUMN_NAME = [
        'abundanceType' => 'abundance',
        'ageRange' => 'actress_age_range',
        'analAmount' => 'anal_percentage',
        'assSize' => 'actress_ass_size',
        'blowjobAmount' => 'blowjob_percentage',
        'cameraStyle' => 'camera_style',
        'cumshotType' => 'actor_cumshot_type',
        'doublePenetrationAmount' => 'double_penetration_percentage',
        'feetPettingAmount' => 'feet_petting_percentage',
        'hairColor' => 'actress_hair_color',
        'handjobAmount' => 'handjob_percentage',
        'hasStory' => 'has_story',
        'isCumshotCompilation' => 'is_cumshot_compilation_type',
        'isFemaleDomination' => 'is_female_domination_type',
        'isSadisticOrMasochistic' => 'is_sadistic_or_masochistic',
        'isTranslatedToPolish' => 'is_translated_to_polish',
        'movieDuration' => 'duration',
        'position69amount' => 'position_69_percentage',
        'professionalismLevel' => 'is_professional_production',
        'pussyLickingAmount' => 'pussy_licking_percentage',
        'race' => 'actress_race',
        'recordedBySpyCamera' => 'recorded_by_spy_camera',
        'shavedPussy' => 'shows_shaved_pussy',
        'showGlasses' => 'actress_has_glasses',
        'showHighHeels' => 'shows_high_heels',
        'showHugeCock' => 'shows_big_cock',
        'showPantyhose' => 'actress_has_pantyhose',
        'showSexToys' => 'shows_sex_toys',
        'showStockings' => 'actress_has_stockings',
        'showWhips' => 'shows_wips',
        'thicknessSize' => 'actress_thickness',
        'titfuckAmount' => 'tittfuck_percentage',
        'titsSize' => 'actress_tits_size',
        'vaginalAmount' => 'pussy_fuck_percentage',
        'title' => 'title'
     ];

    public function handle(Request $request) : JsonResponse
    {
        try {
            $validationResult = MoviePropertiesValidator::validate($request);
            if($validationResult['success']) {
                $validatedData = $validationResult['data'];
                $simpleValues = $this->getSimpleValues($validatedData); 
                $movieCandidate = new MovieCandidate($simpleValues);
                $this->getValuesForColumnsContainingForeignKeys($validatedData, $movieCandidate);
                $this->parsePornstarsList($validatedData, $movieCandidate);
                $movieCandidate->save();
                return new JsonResponse($movieCandidate, 201);
            } else {
                return new JsonResponse(['errors' => $validationResult['errors']], 400);
            }
        } catch (Throwable $failure) {
            return new JsonResponse(['errorMessage' => $failure->getMessage()], 500);
        }
    }

    protected function getValuesForColumnsContainingForeignKeys(array $validatedData, MovieCandidate $movieCandidate) : void
    {
       
        if(array_key_exists('nationality', $validatedData)) {
            $nationality = Nationality::where(['name' => $validatedData['nationality']])->get()->first();
            $movieCandidate->actressNationality()->associate($nationality);
        }

        if(array_key_exists('location', $validatedData)) {
            $location = Location::where(['name' => $validatedData['location']])->get()->first();
            $movieCandidate->location()->associate($location);
        }

        if(array_key_exists('storyOrCostume', $validatedData)) {
            $storyOrCostumeType = StoryOrCostumeType::where(['name' => $validatedData['storyOrCostume']])->get()->first();
            $movieCandidate->storyOrCostumeType()->associate($storyOrCostumeType);
        }

    }

    protected function parsePornstarsList(array $validatedData, MovieCandidate $movieCandidate) : void
    {
        if(array_key_exists('pornstarsList', $validatedData)) {
            $movieCandidate->pornstarList = explode(',', $validatedData['pornstarsList']);
        } 
    }

    protected function getSimpleValues(array $validatedData) : array {
        $simpleValues = array_diff_key($validatedData, array_flip(['nationality', 'location', 'storyOrCostume']));
        if(array_key_exists('professionalismLevel', $simpleValues)){
            $simpleValues['professionalismLevel'] = match($simpleValues['professionalismLevel']) {
                'professional' => 1,
                'amateur' => 0,
                default => null
            };
        }
        $dataWithTransformedNames = [];
        foreach($simpleValues as $propertyName => $value) {
            $dataWithTransformedNames[self::MAP_PROPERTY_NAME_TO_COLUMN_NAME[$propertyName]] = $value;
        }
       return $dataWithTransformedNames;
    }
}