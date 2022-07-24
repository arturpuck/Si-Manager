<x-main title="{{__('menager_dashboard')}}">
    <h1 class="dashboard-header">{{__('menager_dashboard')}}</h1>
  <main class="content">
    <ul class="options-list">
        @hasanyrole('movieCreator|admin')
        <li class="option">
           <a href="{{route('movie-candidate.panel')}}" class="option-link">{{__('add_movie_candidates')}}</a>
        </li>
        @endhasanyrole
        @role('admin')
        <li class="option">
            <a href="{{route('movie.panel')}}" class="option-link">{{__('submit_movies')}}</a>
        </li>
        @endrole
        <li class="option">
          <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="logout-button">{{__('logout')}}</button>
          </form>
        </li>
    </ul>
  </main>
</x-main>