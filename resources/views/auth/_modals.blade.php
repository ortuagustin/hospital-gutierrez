@if (Auth::guest())
    @include('auth._login')
    @include('auth._register')
@else
    @include('auth._logout')
@endif