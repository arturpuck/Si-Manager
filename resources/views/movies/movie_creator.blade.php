<x-main title="{{__('add_movie')}}">
<h1 class="main-header">{{__('movie_add_edit_panel')}}</h1>
    <movie-edit-create 
    v-on:updated-movie-candidate="updateResourcesTableItem"
    ></movie-edit-create>
    <section v-show="anyMovieCandidatesAvailable">
        <h2 class="main-header">{{__('added_movies_awaiting_confirmation')}}</h2>
        <simple-resource-table v-on:edit="loadResourceValuesToEditor"></simple-resource-table>
   </section>
   <user-notification></user-notification>
</x-main>