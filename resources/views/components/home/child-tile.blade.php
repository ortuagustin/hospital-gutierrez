<div class="tile is-parent">
    <article class="tile is-child box notification {{ $class or '' }} {{ $type or '' }}">

        <p class="title">{{ $title or '' }}</p>
        <p class="subtitle">{{ $subtitle or '' }}</p>

        <div class="content">
            {{ $slot }}
        </div>

    </article>
</div>
