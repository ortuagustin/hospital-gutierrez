@extends('layouts.app')

@section('content')

<div class="tile is-ancestor">

    <div class="tile is-vertical">
        <div class="tile is-parent">
            <article class="tile is-child box notification is-white">

                <p class="title">Wide column</p>
                <p class="subtitle">With some content</p>

                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
                </div>

            </article>
        </div>

        <div class="tile is-parent">
            <article class="tile is-child box notification is-light">

                <p class="title">Wide column</p>
                <p class="subtitle">With some content</p>

                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
                </div>

            </article>
        </div>
    </div>

</div>

<div class="tile is-ancestor">

    <div class="tile">

        <div class="tile is-parent">
            <article class="tile is-child box notification is-danger has-text-centered">

                <div class="content">
                    {!! icon('fas fa-user fa-5x', 'is-large') !!}
                </div>

                <p class="title">First column</p>
                <p class="subtitle">With some content</p>

                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
                </div>

            </article>
        </div>

        <div class="tile is-parent">
            <article class="tile is-child box notification is-info has-text-centered">

                <div class="content">
                    {!! icon('fas fa-user fa-5x', 'is-large') !!}
                </div>

                <p class="title">Second column</p>
                <p class="subtitle">With some content</p>

                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
                </div>

            </article>
        </div>

        <div class="tile is-parent">
            <article class="tile is-child box notification is-success has-text-centered">

                <div class="content">
                    {!! icon('fas fa-user fa-5x', 'is-large') !!}
                </div>

                <p class="title">Third column</p>
                <p class="subtitle">With some content</p>

                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
                </div>

            </article>
        </div>

    </div>

</div>

@endsection
