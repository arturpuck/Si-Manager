const movieViewsOptions = [
    'minimumMovieViews', 'maximumMovieViews'
];

const movieTimeOptions = [
    'minimumMovieTime',
    'maximumMovieTime'
];

const variables: {
    initialValueIsEmptyString: string[],
    initialValueIsFalse: string[],
    pornstars_list: string,
    initialValueIsZero: string[],
    movieTimeOptions: string[],
    movieViewsOptions: string[],
    groupNames: string[],
    viewsAndTimeOptions: string[]
} = {

    initialValueIsEmptyString: ['abundance', 'actress_tits_size', 'actress_ass_size', 'actress_thickness', 'actress_age_range', 'actress_hair_color', 'actress_race',
        'actress_nationality', 'shows_shaved_pussy', 'anal_percentage', 'blowjob_percentage', 'handjob_percentage', 'double_penetration_percentage', 'pussy_fuck_percentage', 'pussy_licking_percentage', 'feet_petting_percentage',
        'feet_petting_percentage', 'position_69_percentage', 'actor_cumshot_type', 'location', 'camera_style', 'has_story', 'story_or_costume_type',
        'is_professional_production'],

    initialValueIsFalse: ['is_cumshot_compilation_type', 'recorded_by_spy_camera', 'is_sadistic_or_masochistic', 'is_female_domination_type',
        'is_translated_to_polish', 'actress_has_pantyhose', 'actress_has_stockings', 'actress_has_glasses', 'shows_high_heels', 'shows_big_cock',
        'shows_whips', 'shows_sex_toys'
    ],

    viewsAndTimeOptions : [
        'minimumMovieTimeRaw',
        'maximumMovieTimeRaw',
        'minimumMovieViewsRaw',
        'maximumMovieViewsRaw'
    ],

    initialValueIsZero: [...movieTimeOptions, ...movieViewsOptions],
    movieTimeOptions,
    movieViewsOptions,
    pornstars_list: "pornstars_list",
    groupNames: ['initialValueIsEmptyString', 'initialValueIsFalse', 'movieTimeOptions', 'movieViewsOptions'],

}


export default variables;