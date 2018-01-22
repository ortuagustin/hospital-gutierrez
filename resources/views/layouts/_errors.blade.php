{{-- Will display all validation errors --}}

@if (count($errors))
  <div class="notification is-danger">
    <div class="container">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif
