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

const EventBus = EventEmmiter();
const settings = {

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
  },

  mounted() {
    this.csrfToken = (<HTMLMetaElement>document.getElementById("csrf-token")).content;
    this.getPendingMovieCandidates();
  }

};
//@ts-ignore
const app = createApp(settings);
app.config.globalProperties.emitter = EventBus;

app.mount("#app");
