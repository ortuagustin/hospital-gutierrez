{{ csrf_field() }}

<div class="field">
  <label class="label">Permission</label>
  <div class="control">
    <input class="input" type="text" name="name" value="{{ old('name', $permission->name) }}" placeholder="The Permission name">
    @include('layouts.field_errors', ['errors,' => 'errors', 'field' => 'name'])
  </div>
</div>

<div class="field is-grouped">
  <div class="control">
    <button type="submit" class="button is-primary">
        {{ $submitButtonText }}
    </button>
  </div>
  <div class="control">
    <a class="button is-danger is-outlined " href={{ route('permissions.index') }}>
        {{ isset($cancelButtonText) ?: 'Cancel' }}
    </a>
  </div>
</div>
