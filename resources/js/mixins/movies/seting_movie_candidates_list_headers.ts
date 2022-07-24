export default {
    methods : {
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
    }
}