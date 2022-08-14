<x-main title="{{__('sex_empire_manager_login_panel')}}">
    @if($errors->any())
     <div class="error-information">Błędne dane logowania</div>
    @endif
    <login-form></login-form>
</x-main>