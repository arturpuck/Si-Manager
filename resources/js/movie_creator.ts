import { createApp } from 'vue';
import EventEmmiter from 'mitt';
import UserNotification from '@jscomponents/user_notification.vue';
import MovieEditCreate from '@jscomponents/movie_edit_create';
import SimpleResourceTable from '@jscomponents/simple_resource_table';
import UserNotificationCalls from "@js/mixins/user_notification_call";
import DeletingMovieCandidate from "@js/mixins/movies/deleting_movie_candidate";
import SettingMovieCandidateListHeaders from "@js/mixins/movies/seting_movie_candidates_list_headers";
import GettingPendingMovieCandidates from "@js/mixins/movies/geting_pending_movie_candidates";
import UpdatingMovieCandidatesTable from "@js/mixins/movies/updating_movie_candidates_table";
import LoadingMovieCandidatesValuesToEditor from "@js/mixins/movies/loading_movie_candidates_values_to_editor";
import AddingNewMovieCandidatesToTable from "@js/mixins/movies/adding_new_movie_candidates_to_table";
import AcceptButton from "@jscomponents-form-controls/accept_button";
import Translator from "@jsmodules/translator.js";

const EventBus = EventEmmiter();
const settings = {

  data() {
    return {
      movies: []
    }
  },

  computed: {
    anyMovieCandidatesAvailable(): boolean {
      return this.movies.length > 0
    }
  },

  methods: {
    deleteAllMovieCandidates(): void {
      this.makeDeleteMovieCandidatesRequest('all')
        .then(this.processDeletedMovieCandidateResponse);
    },

    updateMovies(movies): void {
      this.movies = movies;
    },

    createAllMoviesFromList(): void {
      let movieCandidatesIds = this.getAllMovieCandidatesIds();
      this.makeAcceptMovieRequest(movieCandidatesIds)
        .then(this.processMovieCreationResponse);
    },

    getAllMovieCandidatesIds() {
      let candidates_ids = this.movies.map(movieCandidate => movieCandidate.id);
      return { candidates_ids }
    },

    createMovie(movie): void {
      this.makeAcceptMovieRequest({ candidates_ids: [movie.id] })
        .then(this.processMovieCreationResponse);
    },

    makeAcceptMovieRequest(moviCandidatesIDs) {
      const requestData = {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': this.csrfToken,
          'Content-type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify(moviCandidatesIDs),
      };

      return fetch('/movie', requestData);
    },

    async processMovieCreationResponse(response) {
      let responseBody = await response.json();

      switch (response.status) {
        case 201:
          this.addedMovieCandidatesCleanUp(responseBody.deletedCandidates);
          break;

        case 400:
          this.showMovieCandidateValidationErrors(responseBody.errors);
          break;

        case 500:
          this.notifyEmployeeAboutServerError(responseBody.errorMessage);
          break;

        case 419:
          this.showUserNotification('session_expired_login_again', 'error', true);
      }
    },

    addedMovieCandidatesCleanUp(addedMovieCandidates: number[]): void {
      this.removeMovieCandidatesFromList(addedMovieCandidates);
      this.showUserNotification('movie_or_movies_added_successfully');
    },

    showMovieCandidateValidationErrors(errors): void {
      let errorMessage = `${Translator.translate('validation_error')} : `;
      errorMessage += JSON.stringify(errors);
      this.showUserNotification(errorMessage, 'error', true);
    }
  },

  mixins: [
    UserNotificationCalls,
    DeletingMovieCandidate,
    SettingMovieCandidateListHeaders,
    GettingPendingMovieCandidates,
    UpdatingMovieCandidatesTable,
    LoadingMovieCandidatesValuesToEditor,
    AddingNewMovieCandidatesToTable
  ],

  components: {
    UserNotification,
    MovieEditCreate,
    SimpleResourceTable,
    AcceptButton
  },

  mounted() {
    this.csrfToken = (<HTMLMetaElement>document.getElementById("csrf-token")).content;
    this.setMovieCandidatesListHeaders();
    this.getPendingMovieCandidates();
  }

};
//@ts-ignore
const app = createApp(settings);
app.config.globalProperties.emitter = EventBus;

app.mount("#app");