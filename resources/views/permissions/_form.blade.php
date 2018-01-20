{{ csrf_field() }}

<div class="field">

    <label class="label">Permission</label>

    <div class="control">
        <input class="input" type="text" name="name" value="{{ old('name', $permission->name) }}" placeholder="The Permission name" autofocus>

        @include('layouts.field_errors', ['errors,' => 'errors', 'field' => 'name'])
    </div>

</div>

<div class="field is-grouped">

    <div class="control">
        <button type="submit" class="button is-primary">{{ $submitButtonText }}</button>
    </div>

    <div class="control">
        {!! link_to('Cancel', 'patients.index', [], 'button is-danger is-outlined') !!}
    </div>

</div>
