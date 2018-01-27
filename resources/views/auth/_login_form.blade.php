{{ csrf_field() }}

<div class="field">
    <div class="control has-icons-left">
        <input id="email" name="email" class="input is-medium" type="text" value="{{ old('email') }}" placeholder="Username / E-Mail" autofocus>
        {!! icon('fas fa-user', 'is-left') !!}

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
    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me?
</div>

<div class="field">
    <div class="control has-text-centered">
        <button type="submit" class="button is-info is-medium">Login</button>
    </div>
</div>
