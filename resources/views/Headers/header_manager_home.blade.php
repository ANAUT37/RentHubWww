@if (Auth::check())
    @include('Headers.sessioned_home')
@else
    @include('Headers.no_session_home')
@endif
