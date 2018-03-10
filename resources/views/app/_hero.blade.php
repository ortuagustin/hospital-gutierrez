<section class="hero is-primary is-small">
    <div class="hero-body">
        <div class="container has-text-centered">
            @hasSection('hero-body-content')
                @yield('hero-body-content')
            @else
                <h1 class="title" v-pre>{{ setting('title') }}</h1>
                <h2 class="subtitle" v-pre>{{ setting('description') }}</h2>
            @endif
        </div>
    </div>

    @includeWhen(Auth::check(), 'app._hero_footer')
</section>