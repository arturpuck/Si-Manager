<?php

namespace App\CustomValidators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MoviePropertiesValidator
{

    private const ABUNDANCE_TYPES = [
        'one_male_one_female',
        'bukkake',
        'single_female',
        'lesbian',
        'group',
        'one_male_many_females',
        'GangBang',
        'one_female_two_males',
        'lesbianGroup'
    ];

    private const SMB_SIZES = [
        'small',
        'medium',
        'big'
    ];

    private const THICKNESS_SIZES = [
        'skinny',
        'medium',
        'fat'
    ];

    private const AGE_RANGES = [
        'teenagers',
        'young',
        'mature'
    ];

    private const HAIR_COLORS = [
        'dark',
        'blonde',
        'brown',
        'red'
    ];

    private const RACES = [
        'white',
        'asian',
        'ebony',
        'latin',
        'arabic'
    ];

    private const CUMSHOT_TYPES = [
        'on_face',
        'cum_swallow',
        'creampie',
        'anal_creampie',
        'on_tits',
        'on_pussy',
        'on_ass',
        'on_feet',
        'on_many_places',
        'on_other_body_parts',
        'exclude'
    ];

    private const CAMERA_STYLES = [
        'outside',
        'POV',
        'mixed'
    ];

    private const PROFESSIONALISM_LEVELS = [
        'professional',
        'amateur'
    ];

    public static function getRules(): array
    {

        $sexTypeRule = ['nullable', 'integer', 'min:1', 'max:100'];

        $rules = [
            'title' => ['required', 'string', 'min:3', 'max:255'],

            'abundanceType' => ['required', 'string', Rule::in(self::ABUNDANCE_TYPES)],
            'titsSize' => ['string', 'nullable', Rule::in(self::SMB_SIZES)],
            'assSize' => ['string', 'nullable', Rule::in(self::SMB_SIZES)],
            'thicknessSize' => ['string', 'nullable', Rule::in(self::THICKNESS_SIZES)],
            'ageRange' => ['string', 'nullable', Rule::in(self::AGE_RANGES)],
            'hairColor' => ['string', 'nullable', Rule::in(self::HAIR_COLORS)],
            'race' => ['string', 'nullable', Rule::in(self::RACES)],
            'nationality' => ['string', 'nullable', 'exists:nationalities,name'],
            'shavedPussy' => ['nullable', 'boolean'],
            'cumshotType' => ['string', 'nullable', Rule::in(self::CUMSHOT_TYPES)],
            'location' => ['string', 'nullable', 'exists:locations,name'],
            'cameraStyle' => ['required', 'string', Rule::in(self::CAMERA_STYLES)],
            'hasStory' => ['nullable', 'boolean'],
            'storyOrCostume' => ['string', 'nullable', 'exists:story_or_costume_types,name'],
            'professionalismLevel' => ['nullable', 'string', Rule::in(self::PROFESSIONALISM_LEVELS)],
            'movieDuration' => ['date_format:H:i:s', 'after:00:00:00'],

            'analAmount' => $sexTypeRule,
            'blowjobAmount' => $sexTypeRule,
            'doublePenetrationAmount' => $sexTypeRule,
            'vaginalAmount' => $sexTypeRule,
            'pussyLickingAmount' => $sexTypeRule,
            'titfuckAmount' => $sexTypeRule,
            'feetPettingAmount' => $sexTypeRule,
            'position69amount' => $sexTypeRule,

            'pages' => ['nullable', 'numeric', 'min:0'],

            'isCumshotCompilation' => ['boolean', 'nullable'],
            'recordedBySpyCamera' => ['boolean', 'nullable'],
            'isSadisticOrMasochistic' => ['boolean', 'nullable'],
            'isFemaleDomination' => ['boolean', 'nullable'],
            'isTranslatedToPolish' => ['boolean', 'nullable'],
            'showPantyhose' => ['boolean', 'nullable',],
            'showStockings' => ['boolean', 'nullable'],
            'showGlasses' => ['boolean', 'nullable'],
            'showHighHeels' => ['boolean', 'nullable'],
            'showHugeCock' => ['boolean', 'nullable'],
            'showWhips' => ['boolean', 'nullable'],
            'showSexToys' => ['boolean', 'nullable'],

            'pornstarsList' => ['nullable', 'array'],
            'pornstarsList.*' => ['nullable', 'string', 'exists:pornstars,nickname']
        ];

        return $rules;
    }

    //if you wonder why I didn't use a custom request validation, that's because custom requests break
    // when more fields get validated

    public static function validate(Request $request): array
    {
        
        $validator = Validator::make($request->all(), self::getRules());
        return $validator->fails() ? ['success' => false, 'errors' => $validator->errors()->all()]  : 
         ['success' => true, 'data' => $validator->validated()];
    }
}
