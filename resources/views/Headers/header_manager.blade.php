@if (Auth::check())
    @include('Headers.sessioned')
@else
    @include('Headers.no_session')
@endif
