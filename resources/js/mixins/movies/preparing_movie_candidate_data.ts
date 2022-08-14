export default {
    methods : {

          prepareMovieCandidateData(responseBody: object[]): object[] {
            let responseData = this.changeHowDatesAreDisplayed(responseBody);
            return responseData;
          },

          changeHowDatesAreDisplayed(responseBody: object[]): object[] {
            const dateDisplayOptions = { year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric' };
            return responseBody.map(resource => {
              //@ts-ignore
              resource['created_at'] = new Date(resource['created_at']).toLocaleDateString('pl-PL', dateDisplayOptions);
              //@ts-ignore
              resource['updated_at'] = new Date(resource['updated_at']).toLocaleDateString('pl-PL', dateDisplayOptions);
              return resource;
            })
          },
    }
}