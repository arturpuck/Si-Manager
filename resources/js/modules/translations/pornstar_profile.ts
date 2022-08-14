import Translator from '@jsmodules/translator.js';

const translations : {
    currentNumberOfVotes : string,
    movieAverageRating : string,
    averageRateNotAvailableYet : string,
    thisPornstarDoesNotHaveEnoughVotesToCalculateAverageRate : string,
    fetchingRatingInProgress : string,
} = {
    currentNumberOfVotes : Translator.translate('current_number_of_votes'),
    movieAverageRating : Translator.translate('movie_average_rating'),
    averageRateNotAvailableYet : Translator.translate('average_rate_not_available_yet'),
    thisPornstarDoesNotHaveEnoughVotesToCalculateAverageRate : Translator.translate('this_pornstar_does_not_have_enough_votes_to_calculate_average'),
    fetchingRatingInProgress : Translator.translate('fetching_rating_in_progress'),
}

export default translations;