export default {
    methods : {
        loadResourceValuesToEditor(movie: object) {
            this.emitter.emit('loadMovieProperties', movie);
          }
    }
}