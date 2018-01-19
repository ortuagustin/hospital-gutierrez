{{ csrf_field() }}

<div class="field">
  <label class="label">Role</label>
  <div class="control">
    <input class="input" type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="The Role name">
    @include('field_errors', ['errors,' => 'errors', 'field' => 'name'])
  </div>
</div>

<div class="field is-grouped">
  <div class="control">
    <button type="submit" class="button is-primary">
        {{ $submitButtonText }}
    </button>
  </div>
  <div class="control">
    <a class="button is-danger is-outlined " href={{ route('roles.index') }}>
        {{ isset($cancelButtonText) ?: 'Cancel' }}
    </a>
  </div>
</div>
