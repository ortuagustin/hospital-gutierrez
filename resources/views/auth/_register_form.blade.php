{{ csrf_field() }}

<div class="field">
    <div class="control has-icons-left">
        <input id="name" name="name" class="input is-medium" type="text" value="{{ old('name') }}" placeholder="Username" autofocus>
        {!! icon('fas fa-user', 'is-left') !!}

        @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'name'])
    </div>
</div>

<div class="field">
    <div class="control has-icons-left">
        <input id="email" name="email" class="input is-medium" type="email" value="{{ old('email') }}" placeholder="E-Mail">
        {!! icon('fas fa-envelope', 'is-left') !!}

        @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'email'])
    </div>
</div>

<div class="field">
    <div class="control has-icons-left">
        <input id="password" name="password" class="input is-medium" type="password" placeholder="Password">
        {!! icon('fas fa-key', 'is-left') !!}

        @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'password'])
    </div>
</div>

<div class="field">
    <div class="control has-icons-left">
        <input id="password_confirmation" name="password_confirmation" class="input is-medium" type="password" placeholder="Confirm your password">
        {!! icon('fas fa-key', 'is-left') !!}
    </div>
</div>

<br>

<div class="field">
    <div class="control has-text-centered">
        <button type="submit" class="button is-info is-medium">Register</button>
    </div>
</div>
