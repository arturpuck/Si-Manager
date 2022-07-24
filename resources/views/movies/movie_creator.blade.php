<x-main title="{{__('add_movies')}}">
    <x-navbar></x-navbar>
    <section v-show="anyMovieCandidatesAvailable">
        <h2 class="main-header">{{__('added_movies_awaiting_confirmation')}}</h2>
        <simple-resource-table 
        v-on:delete="deleteMovieCandidate"
        v-on:edit="loadResourceValuesToEditor"></simple-resource-table>
        <div class="mass-operation-container">
            <accept-button class="mass-operation-control">{{__('create_all_from_list')}}</accept-button>
            <button class="mass-operation-control delete-button">{{__('delete_all_from_list')}}</button>
        </div>
   </section>
    <movie-edit-create 
    v-on:updated-movie-candidate="updateMovieCandidatesTable"
    v-on:added-new-movie-candidate="addNewMovieCandidatesToTable"
    ></movie-edit-create>
   <user-notification></user-notification>
</x-main>