import UserNotificationCalls from "@js/mixins/user_notification_call";
import SettingMovieCandidateListHeaders from "@js/mixins/movies/seting_movie_candidates_list_headers";
import AddingNewMoviesToTable from "@js/mixins/movies/adding_new_movie_candidates_to_table";

export default {
    mixins : [UserNotificationCalls, SettingMovieCandidateListHeaders, AddingNewMoviesToTable],

    data() {
      return { 
        anyMovieCandidatesAvailable : false
      }
    },

    methods : {
        async getPendingMovieCandidates() {
            const requestData = {
              method: 'GET',
              headers: {
                'X-CSRF-TOKEN': this.csrfToken,
              }
            };
      
            const response = await fetch('/movie-candidate', requestData);
            this.processPendingMovieCandidatesResponse(response);
      
          },

          async processPendingMovieCandidatesResponse(response) {
            let responseBody = await response.json();
            switch (response.status) {
              case 200:
                this.processSuccessfullMovieCandidatesFetch(responseBody);
                break;
      
              case 400:
                this.notifyEmployeeAboutBadRequest(responseBody)
                break;
      
              case 500:
                this.notifyEmployeeAboutServerError(response.body);
                break;
            }
          },

          processSuccessfullMovieCandidatesFetch(movieCandidates) {
            if (Array.isArray(movieCandidates) && movieCandidates.length > 0) {
              if (!this.anyMovieCandidatesAvailable) {
                this.anyMovieCandidatesAvailable = true;
                this.setMovieCandidatesListHeaders();
              }
              this.addNewMovieCandidatesToTable(movieCandidates);
            }
          },
          
    }
}