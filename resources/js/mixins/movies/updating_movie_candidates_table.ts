export default {
    methods : {
        updateMovieCandidatesTable(movieCandidate: object): void {
            movieCandidate = this.prepareMovieCandidateData([movieCandidate]);
            let updateCompleteData: {
              updatedResources: object,
              replacementKey: string
            } = { updatedResources: movieCandidate, replacementKey: 'id' };
            this.emitter.emit('updateExistingResourcesInTable', updateCompleteData);
          },
    }
}