<div class="tile is-parent">
    <article class="tile is-child box notification {{ $class or '' }} {{ $type or '' }}">

        <p class="title">{{ $title }}</p>
        <p class="subtitle">{{ $subtitle }}</p>

        <div class="content">
            {{ $slot }}
        </div>

    </article>
</div>
