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
    pornstarsList: string,
    initialValueIsZero: string[],
    movieTimeOptions: string[],
    movieViewsOptions: string[],
    groupNames: string[],
    viewsAndTimeOptions: string[]
} = {

    initialValueIsEmptyString: ['abundanceType', 'titsSize', 'assSize', 'thicknessSize', 'ageRange', 'hairColor', 'race',
        'nationality', 'shavedPussy', 'analAmount', 'blowjobAmount', 'handjobAmount', 'doublePenetrationAmount', 'vaginalAmount', 'pussyLickingAmount', 'titfuckAmount',
        'feetPettingAmount', 'position69amount', 'cumshotType', 'location', 'cameraStyle', 'hasStory', 'storyOrCostume',
        'professionalismLevel'],

    initialValueIsFalse: ['isCumshotCompilation', 'recordedBySpyCamera', 'isSadisticOrMasochistic', 'isFemaleDomination',
        'isTranslatedToPolish', 'showPantyhose', 'showStockings', 'showGlasses', 'showHighHeels', 'showHugeCock',
        'showWhips', 'showSexToys'
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
    pornstarsList: "pornstarsList",
    groupNames: ['initialValueIsEmptyString', 'initialValueIsFalse', 'movieTimeOptions', 'movieViewsOptions'],

}


export default variables;