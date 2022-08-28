<?php

namespace App\CustomValidators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Exceptions\FailedValidationException;
use App\Helpers\Testing\MovieCandidatesAttributes;

class MoviePropertiesValidator
{

    public static bool $checkMovieID = false;

    public static function getRules(): array
    {

        $sexTypeRule = ['nullable', 'integer', 'min:1', 'max:100'];
        $booleanRule = ['boolean', 'nullable'];

        $rules = [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],

            'abundance' => ['required', 'string', Rule::in(MovieCandidatesAttributes::ABUNDANCES)],
            'actress_tits_size' => ['string', 'nullable', Rule::in(MovieCandidatesAttributes::BODY_PART_SIZES)],
            'actress_ass_size' => ['string', 'nullable', Rule::in(MovieCandidatesAttributes::BODY_PART_SIZES)],
            'actress_thickness' => ['string', 'nullable', Rule::in(MovieCandidatesAttributes::BODY_SIZES)],
            'actress_age_range' => ['string', 'nullable', Rule::in(MovieCandidatesAttributes::AGE_RANGES)],
            'actress_hair_color' => ['string', 'nullable', Rule::in(MovieCandidatesAttributes::HAIR_COLORS)],
            'actress_race' => ['string', 'nullable', Rule::in(MovieCandidatesAttributes::RACES)],
            'actress_nationality' => ['string', 'nullable', 'exists:nationalities,name'],
            'shows_shaved_pussy' => ['nullable', 'boolean'],
            'actor_cumshot_type' => ['string', 'nullable', Rule::in(MovieCandidatesAttributes::CUMSHOT_TYPES)],
            'location' => ['string', 'nullable', 'exists:locations,name'],
            'camera_style' => ['required', 'string', Rule::in(MovieCandidatesAttributes::CAMERA_STYLES)],
            'has_story' => ['nullable', 'boolean'],
            'story_or_costume_type' => ['string', 'nullable', 'exists:story_or_costume_types,name'],
            'is_professional_production' => ['nullable', 'boolean'],
            'duration' => ['required', 'date_format:H:i:s', 'after:00:00:00'],

            'anal_percentage' => $sexTypeRule,
            'blowjob_percentage' => $sexTypeRule,
            'handjob_percentage' => $sexTypeRule,
            'double_penetration_percentage' => $sexTypeRule,
            'pussy_fuck_percentage' => $sexTypeRule,
            'pussy_licking_percentage' => $sexTypeRule,
            'feet_petting_percentage' => $sexTypeRule,
            'position_69_percentage' => $sexTypeRule,
            'tittfuck_percentage' => $sexTypeRule,

            'is_cumshot_compilation_type' => $booleanRule,
            'recorded_by_spy_camera' => $booleanRule,
            'is_sadistic_or_masochistic' => $booleanRule,
            'is_female_domination_type' => $booleanRule,
            'is_translated_to_polish' => $booleanRule,
            'actress_has_pantyhose' => $booleanRule,
            'actress_has_stockings' => $booleanRule,
            'actress_has_glasses' => $booleanRule,
            'shows_high_heels' => $booleanRule,
            'shows_big_cock' => $booleanRule,
            'shows_whips' => $booleanRule,
            'shows_sex_toys' => $booleanRule,
            'shows_latex' => $booleanRule,

            'pornstars_list' => ['nullable', 'array'],
            'pornstars_list.*' => ['nullable', 'string', 'exists:pornstars,nickname']
        ];

        return self::$checkMovieID ? array_merge($rules, ['id' => ['required', 'exists:movie_candidates,id']]) : $rules;
    }

    //if you wonder why I didn't use a custom request validation, that's because custom requests break
    // when more fields get validated

    public static function validate(Request $request): array
    {
        $validator = Validator::make($request->all(), self::getRules());
        if($validator->fails()) {
            throw new FailedValidationException($validator->errors()->all());
        }
        return $validator->validated();
    }
}
