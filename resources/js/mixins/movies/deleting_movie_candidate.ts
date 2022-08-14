
import UserNotificationCalls from "@js/mixins/user_notification_call";

export default {
    mixins: [UserNotificationCalls],

    methods: {

        async deleteMovieCandidate(movieCandidate) {
            this.makeDeleteMovieCandidatesRequest(movieCandidate.id)
                .then(this.processDeletedMovieCandidateResponse);
        },

        async makeDeleteMovieCandidatesRequest(range: number | string) {
            const requestData = {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                }
            };

            return fetch(`/movie-candidate?id=${range}`, requestData);
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

        successfullyDeletedMovieCandidateProcedure(movieCandidateId: number | string): void {
            this.showUserNotification('movie_candidate_successfully_deleted');
            
            switch (true) {
                case movieCandidateId === 'all':
                    this.flushMovieCandidatesTable()
                    break;

                default:
                    this.removeMovieCandidatesFromList([movieCandidateId]);
                    break;
            }

        },

        flushMovieCandidatesTable(): void {
            this.emitter.emit('flushResourcesTable');
        },

        removeMovieCandidatesFromList(movieCandidatesIds : any[]): void {
            const deleteData: {
                deleteKey: string,
                deletedResourceIdentifiers: any[]
            } = {
                deleteKey: 'id',
                deletedResourceIdentifiers: movieCandidatesIds
            };
            this.emitter.emit('removeResourcesFromTable', deleteData);
        },
    }
}