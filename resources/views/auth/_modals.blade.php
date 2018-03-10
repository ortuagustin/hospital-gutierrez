@if (Auth::guest())
    @include('auth._login')
    @includeWhen(notOnMaintenance(), 'auth._register')
@else
    @include('auth._logout')
@endif