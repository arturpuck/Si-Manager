import PreparingMovieCandidateData from "@js/mixins/movies/preparing_movie_candidate_data";

export default {
  mixins : [PreparingMovieCandidateData],

    methods : {
        addNewMovieCandidatesToTable(movieCandidates): void {
            movieCandidates = Array.isArray(movieCandidates) ? movieCandidates : [movieCandidates];
            movieCandidates = this.prepareMovieCandidateData(movieCandidates);
            this.emitter.emit('addNewResourcesToTable', movieCandidates);
          },

    }
}