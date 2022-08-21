<x-main title="{{__('add_movie_candidates')}}">
<h1 class="main-header">{{__('movie_add_edit_panel')}}</h1>
    <x-navbar></x-navbar>
    <movie-edit-create 
    v-on:updated-movie-candidate="updateMovieCandidatesTable"
    v-on:added-new-movie-candidate="addNewMovieCandidatesToTable"
    ></movie-edit-create>
    <section v-show="anyMovieCandidatesAvailable">
        <h2 class="main-header">{{__('added_movies_awaiting_confirmation')}}</h2>
        <simple-resource-table 
        v-on:delete="deleteMovieCandidate"
        v-on:resources-have-changed="controlResourcesTableVisibility"
        v-on:edit="loadResourceValuesToEditor"></simple-resource-table>
   </section>
   <user-notification></user-notification>
</x-main>