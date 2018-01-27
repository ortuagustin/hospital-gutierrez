{{ csrf_field() }}

<div class="field">
    <div class="control has-icons-left">
        <input id="email" name="email" class="input is-medium" type="email" value="{{ old('email') }}" placeholder="E-Mail">
        {!! icon('fas fa-envelope', 'is-left') !!}

        @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'email'])
    </div>
</div>

<br>

<div class="field">
    <div class="control has-text-centered">
        <button type="submit" class="button is-info is-medium">Send Password Reset Link</button>
    </div>
</div>
