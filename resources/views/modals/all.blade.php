@if(!Auth::check())
    @include('modals.login')
    @include('modals.register')
@endif
