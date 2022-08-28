<?php

namespace App\Helpers\Testing;

use Illuminate\Support\Str;
use App\Models\Nationality;
use App\Models\Location;
use App\Models\StoryOrCostumeType;
use App\Models\Pornstar;

Class MovieCandidatesAttributes
{

    public const SEX_TYPES = [
        'anal_percentage',
        'blowjob_percentage',
        'handjob_percentage',
        'double_penetration_percentage',
        'pussy_fuck_percentage',
        'pussy_licking_percentage',
        'feet_petting_percentage',
        'position_69_percentage',
        'tittfuck_percentage',
    ];

    public const CAMERA_STYLES = [
            'outside', 
            'mixed', 
            'POV'
    ];

    public const ABUNDANCES = [
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

    public const CUMSHOT_TYPES = [
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

    public const AGE_RANGES = [
            'teenagers',
            'young',
            'mature'
    ];

    public const BODY_PART_SIZES = [
            'small',
            'medium',
            'big'
    ];

    public const HAIR_COLORS = [
            'dark',
            'blonde',
            'brown',
            'red'
    ];

    public const RACES = [
            'white',
            'asian',
            'ebony',
            'latin',
            'arabic'
    ];

    public const BODY_SIZES = [
            'skinny',
            'medium',
            'fat'
    ];

    public const RELATIONS_VISIBLE_IN_RESPONSE_AS_ARRAY = [
        'location' => 'name',
        'story_or_costume_type' => 'name',
        'actress_nationality' => 'name'
    ];


    public static function getRandomCompletePayload() : array
    {
        return [
        'abundance' => self::getRandomAbundance(),
        'actor_cumshot_type' => self::getRandomCumshotType(),
        'actress_age_range' => self::getRandomAgeRange(),
        'actress_ass_size' => self::getRandomBodyPartSize(),
        'actress_hair_color' => self::getRandomHairColor(),
        'actress_has_glasses' => boolval(rand(0, 1)),
        'actress_has_pantyhose' => boolval(rand(0, 1)),
        'actress_has_stockings' => boolval(rand(0, 1)),
        'actress_nationality' => self::getRandomColumnValue(Nationality::class),
        'actress_race' => self::getRandomRace(),
        'actress_thickness' => self::getRandomBodySize(),
        'actress_tits_size' => self::getRandomBodyPartSize(),
        'anal_percentage' => rand(1, 100),
        'blowjob_percentage' => rand(1, 100),
        'camera_style' => self::getRandomCameraStyle(),
        'description' => Str::random(rand(7, 150)),
        'double_penetration_percentage' => rand(1, 100),
        'duration' => date('H:i:s', rand(1, 200000)),
        'feet_petting_percentage' => rand(1, 100),
        'handjob_percentage' => rand(1, 100),
        'has_story' => boolval(rand(0, 1)),
        'is_cumshot_compilation_type' => boolval(rand(0, 1)),
        'is_female_domination_type' => boolval(rand(0, 1)),
        'is_professional_production' => boolval(rand(0, 1)),
        'is_sadistic_or_masochistic' => boolval(rand(0, 1)),
        'is_translated_to_polish' => boolval(rand(0, 1)),
        'location' => self::getRandomColumnValue(Location::class),
        'position_69_percentage' => rand(1, 100),
        'pussy_fuck_percentage' => rand(1, 100),
        'pussy_licking_percentage' => rand(1, 100),
        'pornstars_list' => self::getRandomPornstarsNicknamesArray(),
        'recorded_by_spy_camera' => boolval(rand(0, 1)),
        'shows_big_cock' => boolval(rand(0, 1)),
        'shows_high_heels' => boolval(rand(0, 1)),
        'shows_latex' => boolval(rand(0, 1)),
        'shows_sex_toys' => boolval(rand(0, 1)),
        'shows_shaved_pussy' => boolval(rand(0, 1)),
        'shows_whips' => boolval(rand(0, 1)),
        'story_or_costume_type' => self::getRandomColumnValue(StoryOrCostumeType::class),
        'title' => Str::random(rand(7, 150)),
        'tittfuck_percentage' => rand(1, 100),
        ];
    }

    public static function getRandomAbundance() : string
    {
        return self::ABUNDANCES[array_rand(self::ABUNDANCES)];
    }

    public static function getRandomCameraStyle() : string
    {
        return self::CAMERA_STYLES[array_rand(self::CAMERA_STYLES)];
    }

    public static function getRandomCumshotType() : string
    {
        return self::CUMSHOT_TYPES[array_rand(self::CUMSHOT_TYPES)];
    }

    public static function getRandomAgeRange() : string
    {
        return self::AGE_RANGES[array_rand(self::AGE_RANGES)];
    }

    public static function getRandomBodyPartSize() : string
    {
        return self::BODY_PART_SIZES[array_rand(self::BODY_PART_SIZES)];
    }
    
    public static function getRandomHairColor() : string
    {
        return self::HAIR_COLORS[array_rand(self::HAIR_COLORS)];
    }

    public static function getRandomBodySize() : string
    {
        return self::BODY_SIZES[array_rand(self::BODY_SIZES)];
    }

    public static function getRandomRace() : string
    {
        return self::RACES[array_rand(self::RACES)];
    }

    public static function parseToMatchResponse(array $requestBody) : array
    {
        foreach(self::RELATIONS_VISIBLE_IN_RESPONSE_AS_ARRAY as $relationName => $key) {
            if(isset($requestBody[$relationName]))  {
                $requestBody[$relationName] = [$key => $requestBody[$relationName]];
            }
        }

        if(isset($requestBody['pornstars_list'])) {
            $requestBody['pornstars_list'] = implode(',', $requestBody['pornstars_list']);
        }

        return $requestBody;
    }

    public static function getRandomColumnValue(string $class, string $columnName = 'name') : string
    {
        $randomElement = $class::inRandomOrder()
            ->limit(1)
            ->pluck($columnName)
            ->toArray();

        return array_pop($randomElement);
    }

    public static function getRandomPornstarsNicknamesArray() : array
    {
        return Pornstar::inRandomOrder()
                        ->limit(rand(1,7))
                        ->pluck('nickname')
                        ->toArray();
    }

    public static function getMinimumRequiredPayload() : array
    {
        return [
            'abundance' => self::getRandomAbundance(),
            'duration' => date('H:i:s', rand(1, 200000)),
            'title' => Str::random(rand(7,150)),
            'camera_style' => self::getRandomCameraStyle(),
        ];
    }
}