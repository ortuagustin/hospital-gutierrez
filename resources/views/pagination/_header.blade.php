@if ($paginator->hasPages())

    <nav class="box pagination is-centered">
        @include('pagination._content')
    </nav>

@endif
