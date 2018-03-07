@if ($paginator->hasPages())
    <hr>

    <nav class="pagination is-centered">
        @include('pagination._content')
    </nav>
@endif
