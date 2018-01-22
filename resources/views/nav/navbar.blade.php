<nav class="navbar">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item">
        <img src="https://bulma.io/images/bulma-type-white.png" alt="Logo">
      </a>
      <span class="navbar-burger burger" data-target="navbarMenuHeroA">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </div>
    <div id="navbarMenuHeroA" class="navbar-menu">

      <div class="navbar-end">
        @if (Auth::guest())
            {!! link_to('Login', 'login', [], 'navbar-item') !!}
            {!! link_to('Register', 'register', [], 'navbar-item') !!}
        @else
            {!! link_to('Home', 'home', [], 'navbar-item is-active') !!}
            @include('nav._logout_form')
        @endif
      </div>
    </div>
  </div>
</nav>
