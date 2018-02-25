<a id="logout-button" class="navbar-item" href={{ route('logout') }}>
    Logout
</a>

<form id="logout-form" method="POST" action={{ route('logout') }}>
    {{ csrf_field() }}
</form>

@push('scripts')
    <script src="{{ asset('js/logout_form.js') }}"></script>
@endpush
