<div class="tile is-parent">
    <article class="tile is-child box notification {{ $class or 'has-text-centered'  }} {{ $type or '' }}">
        <a href="{{ $url }}" style="text-decoration: none;">
            <div class="content">
                <span class="icon is-large">
                <i class="{{ $icon }}"></i>
                </span>
            </div>

            <p class="title">{{ $title }}</p>
            <p class="subtitle">{{ $subtitle or '' }}</p>

            <div class="content">
                {{ $slot }}
            </div>
        </a>
    </article>
</div>
