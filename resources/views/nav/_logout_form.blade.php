<a id="logout-button" class="navbar-item" href={{ route('logout') }}>
    Logout
</a>

<form id="logout-form" method="POST" action={{ route('logout') }}>
    {{ csrf_field() }}
</form>

@section('scripts')
    <script src="/js/logout_form.js"></script>
@endsection
