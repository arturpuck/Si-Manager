import { createApp } from 'vue';
import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue';
import EventEmmiter from 'mitt';
import UserNotification from '@jscomponents/user_notification.vue';
import MovieEditCreate from '@jscomponents/movie_edit_create';
import SimpleResourceTable from '@jscomponents/simple_resource_table';
import UserNotificationCalls from "@js/mixins/user_notification_call";

const EventBus = EventEmmiter();
const settings = {

  mixins: [UserNotificationCalls],

  components: {
    ExpectCircle,
    RelativeShadowContainer,
    UserNotification,
    MovieEditCreate,
    SimpleResourceTable
  },

  data() {
    return {
      anyMovieCandidatesAvailable: false
    }
  },

  methods: {
    setMovieCandidatesListHeaders(): void {
      const headers = [
        'id',
        'title',
        'duration',
        'abundance',
        'pornstars_list',
        'created_at',
        'updated_at',
      ];
      this.emitter.emit('updateResourceTableHeaders', headers);
    },

    async getPendingMovieCandidates() {
      const requestData = {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': this.csrfToken,
        }
      };

      const response = await fetch('/movie-candidate', requestData);
      this.processMovieCandidatesResponse(response);

    },

    addNewResourceToTable(responseBody: object[]): void {
      responseBody = this.prepareResourcesData(responseBody);
      this.emitter.emit('addNewResourceToTable', responseBody);
    },

    updateResourcesTableItem(movieCandidate: object) : void {
      movieCandidate = this.prepareResourcesData([movieCandidate]);
      let updateCompleteData : {
        updatedResources: object, 
        replacementKey : string
      } = {updatedResources : movieCandidate, replacementKey : 'id'};
       this.emitter.emit('updateExistingResourcesInTable', updateCompleteData);
    },

    prepareResourcesData(responseBody: object[]): object[] {
          let responseData = this.changeHowDatesAreDisplayed(responseBody);
          return responseData;
    },

    changeHowDatesAreDisplayed(responseBody: object[]): object[] {
      const dateDisplayOptions = {year : 'numeric', month: 'numeric', day: 'numeric', hour : 'numeric', minute : 'numeric' };
        return responseBody.map(resource => {
          //@ts-ignore
          resource['created_at'] = new Date(resource['created_at']).toLocaleDateString('pl-PL', dateDisplayOptions);
          //@ts-ignore
           resource['updated_at'] = new Date(resource['updated_at']).toLocaleDateString('pl-PL', dateDisplayOptions);
           return resource;
        })
    },

    processSuccessFullMovieCandidatesResponse(responseBody) {
      if (Array.isArray(responseBody) && responseBody.length > 0) {
        if (!this.anyMovieCandidatesAvailable) {
          this.anyMovieCandidatesAvailable = true;
          this.setMovieCandidatesListHeaders();
        }
        this.addNewResourceToTable(responseBody);
      }
    },

    async processMovieCandidatesResponse(response) {
      let responseBody = await response.json();
      switch (response.status) {
        case 200:
          this.processSuccessFullMovieCandidatesResponse(responseBody);
          break;

        case 400:
          this.notifyEmployeeAboutBadRequest(responseBody)
          break;

        case 500:
          this.notifyEmployeeAboutServerError(response.body);
          break;
      }
    },

    loadResourceValuesToEditor(movie : object) {
      this.emitter.emit('loadMovieProperties', movie);
    }
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
