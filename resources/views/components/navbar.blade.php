<nav class="navigation">
    <ul class="navigation-list">
        <li class="list-element">
            <a href="{{route('dashboard')}}"  class="navigation-link">{{__('dashboard')}}</a>
        </li>
        <li class="list-element">
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button class="submit-button" type="submit">{{__('logout')}}</button>
            </form>
        </li>
    </ul>
  </nav>