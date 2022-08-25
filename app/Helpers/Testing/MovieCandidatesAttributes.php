<?php

namespace App\Helpers\Testing;

Class MovieCandidatesAttributes
{
    public static function getCameraStyles() : array
    {
        return [
            'outside', 
            'mixed', 
            'POV'
        ];
    }

    public static function getAbundances() : array
    {
        return [
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
    }

    public static function getRandomAbundance() : string
    {
        $abundances = self::getAbundances();
        return $abundances[array_rand($abundances)];
    }

    public static function getRandomCameraStyle() : string
    {
        $cameraStyles = self::getCameraStyles();
        return $cameraStyles[array_rand($cameraStyles)];
    }
}