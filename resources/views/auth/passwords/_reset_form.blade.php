{{ csrf_field() }}

<input type="hidden" name="token" value="{{ $token }}">

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
        <button type="submit" class="button is-info is-medium">Reset Password</button>
    </div>
</div>
