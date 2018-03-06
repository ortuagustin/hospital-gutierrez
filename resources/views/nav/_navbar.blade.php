<navbar inline-template>
    <nav class="navbar is-primary">
        <div class="navbar-brand">
            <a class="navbar-item is-active" href="{{ route('home') }}">
                {!! icon('fas fa-home fa-2x') !!}
                &nbsp;&nbsp; Home
            </a>

            <span class="navbar-burger" :class="burgerClass" @click="toggled = ! toggled">
                <span></span>
                <span></span>
                <span></span>
            </span>

        </div>

        <div class="navbar-menu" :class="burgerClass">
            <div class="navbar-end" v-cloak>
                @include('auth._modals')
            </div>
        </div>
    </nav>
</navbar>