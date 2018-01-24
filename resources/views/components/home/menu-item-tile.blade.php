<div class="tile is-parent">
    <article class="tile is-child box notification has-text-centered {{ $type or '' }}">
        @isset($url)
            <a href="{{ $url }}" style="text-decoration: none;">
        @endisset

            @isset($icon)
                <div class="content">
                    <span class="icon is-large">
                      <i class="{{ $icon }}"></i>
                    </span>
                </div>
            @endisset

            <p class="title">{{ $title }}</p>
            <p class="subtitle">{{ $subtitle or '' }}</p>

            <div class="content">
                {{ $slot }}
            </div>

        @isset($url)
            </a>
        @endisset

    </article>
</div>
