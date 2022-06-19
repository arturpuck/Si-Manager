import Translator from '@jsmodules/translator.js';

const yesNoOptions = {
  1: Translator.translate('yes'),
  0: Translator.translate('no')
};

const sexamounts = {
  only: Translator.translate('only'),
  maximum: Translator.translate('maximum'),
  a_lot: Translator.translate('a_lot'),
  medium: Translator.translate('medium'),
  a_little: Translator.translate('a_little'),
  exclude: Translator.translate('exclude')
};

export default {

  titsSize: {
    small: Translator.translate('small_tits'),
    medium: Translator.translate('medium_tits'),
    big: Translator.translate('big_tits')
  },

  assSize: {
    small: Translator.translate('small_ass'),
    medium: Translator.translate('medium_ass'),
    big: Translator.translate('big_ass')
  },

  thicknessSize: {
    skinny: Translator.translate('skinny_tchickness'),
    medium: Translator.translate('medium_tchickness'),
    fat: Translator.translate('fat_tchickness')
  },

  ageRange: {
    teenagers: Translator.translate('teenagers'),
    young: Translator.translate('age_range_young'),
    mature: Translator.translate('age_range_mature')
  },

  hairColor: {
    dark: Translator.translate('dark_hair'),
    blonde: Translator.translate('blonde_hair'),
    brown: Translator.translate('brown_hair'),
    red: Translator.translate('red_hair'),
  },

  race: {
    white: Translator.translate('white_race'),
    asian: Translator.translate('asian_race'),
    ebony: Translator.translate('ebony_race'),
    latin: Translator.translate('latin_race'),
    arabic: Translator.translate('arabic_race')
  },

  binaryOptions: yesNoOptions,
  shavedPussy: yesNoOptions,
  hasStory: yesNoOptions,

  abundanceType: {
    one_male_one_female: Translator.translate('one_male_one_female'),
    bukkake: Translator.translate('bukkake'),
    single_female: Translator.translate('single_female'),
    lesbian: Translator.translate('lesbians'),
    group: Translator.translate('group_sex'),
    one_male_many_females: Translator.translate('one_male_many_females'),
    GangBang: Translator.translate('GangBang'),
    one_female_two_males: Translator.translate('one_female_two_males'),
    lesbianGroup: Translator.translate('lesbian_group_sex')
  },

  sexamounts,
  analAmount: sexamounts,
  blowjobAmount: sexamounts,
  vaginalAmount: sexamounts,
  pussyLickingAmount: sexamounts,
  titfuckAmount: sexamounts,
  position69amount: sexamounts,
  feetPettingAmount: sexamounts,
  doublePenetrationAmount: sexamounts,
  handjobAmount: sexamounts,

  cumshotType: {
    on_face: Translator.translate('on_face'),
    cum_swallow: Translator.translate('cum_swallow'),
    creampie: Translator.translate('creampie'),
    anal_creampie: Translator.translate('anal_creampie'),
    on_tits: Translator.translate('on_tits'),
    on_pussy: Translator.translate('on_pussy'),
    on_ass: Translator.translate('on_ass'),
    on_feet: Translator.translate('on_feet'),
    on_many_places: Translator.translate('on_many_places'),
    on_other_body_parts: Translator.translate('on_other_body_parts'),
    exclude: Translator.translate('exclude')
  },

  nationality: {
    american: Translator.translate('american_nationality'),
    japanese: Translator.translate('japanese_nationality'),
    german: Translator.translate('german_nationality'),
    czech: Translator.translate('czech_nationality'),
    russian: Translator.translate('russian_nationality'),
    british: Translator.translate('british_nationality'),
    swedish: Translator.translate('swedish_nationality'),
    ukrainian: Translator.translate('ukrainian_nationality'),
    slovac: Translator.translate('slovac_nationality'),
    hanguarian: Translator.translate('hanguarian_nationality'),
    polish: Translator.translate('polish_nationality'),
    dutch: Translator.translate('dutch_nationality'),
    hindu: Translator.translate('hindu_nationality'),
    french: Translator.translate('french_nationality'),
    spanish: Translator.translate('spanish_nationality'),
    italian: Translator.translate('italian_nationality'),
    canadian: Translator.translate('canadian_nationality'),
    argentinian: Translator.translate('argentinian_nationality'),
  },

  location: {
    house: Translator.translate('house'),
    bathroom: Translator.translate('bathroom'),
    office: Translator.translate('office'),
    school: Translator.translate('school'),
    public_place: Translator.translate('public_place'),
    car: Translator.translate('car'),
    nature: Translator.translate('nature'),
    solarium: Translator.translate('solarium'),
    elevator: Translator.translate('elevator'),
    beach: Translator.translate('beach'),
    gym: Translator.translate('gym'),
  },

  cameraStyle: {
    outside: Translator.translate('outside_camera_style'),
    POV: Translator.translate('POV'),
    mixed: Translator.translate('mixed_camera_style')
  },

  storyOrCostume: {
    female_pupil: Translator.translate('female_pupil'),
    female_employee: Translator.translate('female_employee'),
    female_student: Translator.translate('female_student'),
    wife: Translator.translate('wife'),
    female_teacher: Translator.translate('female_teacher'),
    nurse: Translator.translate('nurse'),
    female_slave: Translator.translate('female_slave'),
    nun: Translator.translate('nun'),
    female_police_officer: Translator.translate('female_police_officer'),
    prostitute: Translator.translate('prostitute'),
    female_boss: Translator.translate('female_boss'),
    cleaner: Translator.translate('cleaner'),
    mommy: Translator.translate('mommy')
  },

  professionalismLevel: {
    professional: Translator.translate("professional"),
    amateur: Translator.translate("amateur")
  },

  pornstarsFetchingLabel: Translator.translate("fetching_pornstars"),
  notSelected: Translator.translate("not_selected"),
  selectedTimeLabel: Translator.translate("minutes_inflected"),
  selectedViewsLabel: Translator.translate("views_inflected"),
  fetchingMoviesLabel: Translator.translate("fetching_movies"),
  totalMoviesLabel: Translator.translate("total_movies_found"),
  noMoviesHaveBeenFound: Translator.translate("no_movies_have_been_found"),
  noOptionsHaveBeenSelected: Translator.translate("no_options_have_been_selected"),
  unexpectedError: Translator.translate("unexpected_error_occured"),
  fetchingPornstarsFailed: Translator.translate("failed_to_fetch_pornstars_list"),
  searchHasBenStoppedBecauseThereWereToManyRequests: Translator.translate("because_of_security_reasons_search_was_blocked")

}