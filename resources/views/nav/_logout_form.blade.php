<a class="navbar-item" href={{ route('logout') }}
    onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" method="POST" action={{ route('logout') }}>
    {{ csrf_field() }}
</form>
