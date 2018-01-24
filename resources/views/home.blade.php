@extends('layouts.master')

@section('content')

<div class="tile is-ancestor">

    <div class="tile is-vertical">

        @component('components.home.child-tile')
            @slot('type') is-white @endslot
            @slot('title') Wide Column @endslot
            @slot('subtitle') With Some Content @endslot
            @slot('content') <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. <p> @endslot
        @endcomponent

        @component('components.home.child-tile')
            @slot('type') is-light @endslot
            @slot('title') Wide Column @endslot
            @slot('subtitle') With Some Content @endslot
            @slot('content') <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. <p> @endslot
        @endcomponent

        @component('components.home.child-tile')
            @slot('type') is-white @endslot
            @slot('title') Wide Column @endslot
            @slot('subtitle') With Some Content @endslot
            @slot('content') <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. <p> @endslot
        @endcomponent

    </div>

</div>

<div class="tile is-ancestor">

    <div class="tile">

        @component('components.home.auth-menu-item-tile', ['ability' => 'view', 'args' => \App\Patient::class ])
            @slot('type') is-success @endslot
            @slot('icon') fas fa-user fa-5x @endslot
            @slot('title') Patients @endslot
            @slot('subtitle') Manage the Hospital's Patients @endslot
            @slot('url') {{ route('patients.index') }} @endslot
        @endcomponent

        @component('components.home.menu-item-tile')
            @slot('type') is-info @endslot
            @slot('icon') fas fa-user fa-5x @endslot
            @slot('title') Reports @endslot
            @slot('subtitle') View the Hospital statistics @endslot
            @slot('url') # @endslot
        @endcomponent

        @component('components.home.auth-menu-item-tile', ['ability' => 'admin', 'args' => '' ])
            @slot('type') is-warning @endslot
            @slot('icon') fas fa-user fa-5x @endslot
            @slot('title') Roles @endslot
            @slot('subtitle') Manage Users Roles @endslot
            @slot('url') {{ route('roles.index') }} @endslot
        @endcomponent

        @component('components.home.auth-menu-item-tile', ['ability' => 'admin', 'args' => '' ])
            @slot('type') is-danger @endslot
            @slot('icon') fas fa-user fa-5x @endslot
            @slot('title') Permissions @endslot
            @slot('subtitle') Manage User Permissions @endslot
            @slot('url') {{ route('permissions.index') }} @endslot
        @endcomponent

    </div>

</div>

@endsection
