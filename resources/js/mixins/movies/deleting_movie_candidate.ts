
import UserNotificationCalls from "@js/mixins/user_notification_call";

export default {
    mixins: [UserNotificationCalls],

    methods: {
        async deleteMovieCandidate(movieCandidate) {
            const requestData = {
                method: 'DELETE',
                body: JSON.stringify({ id: movieCandidate.id }),
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    "Content-type": "application/json; charset=UTF-8",
                }
            };

            const response = await fetch('/movie-candidate', requestData);
            this.processDeletedMovieCandidateResponse(response);
        },

        async processDeletedMovieCandidateResponse(response) {
            let responseBody = await response.json();

            switch (response.status) {
                case 200:
                    this.successfullyDeletedMovieCandidateProcedure(responseBody.id);
                    break;

                case 400:
                    this.notifyEmployeeAboutBadRequest(responseBody)
                    break;

                case 500:
                    this.notifyEmployeeAboutServerError(response.errorMessage);
                    break;
            }
        },

        successfullyDeletedMovieCandidateProcedure(movieCandidateId: number): void {
            this.showUserNotification('movie_candidate_successfully_deleted');
            this.removeMovieCandidateFromList(movieCandidateId);
        },

        removeMovieCandidateFromList(movieCandidateId: number): void {
            const deleteData: {
                deleteKey: string,
                deletedResourceIdentifiers: any[]
            } = {
                deleteKey: 'id',
                deletedResourceIdentifiers: [movieCandidateId]
            }
            this.emitter.emit('removeResourcesFromTable', deleteData);
        },
    }
}