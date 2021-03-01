@includeWhen(auth()->check() && auth()->user()->confirmed, 'modals.new-thread')
@if(!Auth::check())
    @include('modals.login')
    @include('modals.register')
@endif
