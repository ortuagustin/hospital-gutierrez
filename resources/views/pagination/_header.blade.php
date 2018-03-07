@if ($paginator->hasPages())
    <nav class="pagination is-centered">
        @include('pagination._content')
    </nav>

    <hr>
@endif
