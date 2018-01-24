<div class="hero-foot">
    <nav class="tabs is-centered is-large">
        <ul>
            @can ('view', \App\Patient::class)
                <li> {!! link_to('Patients', 'patients.index', []) !!} </li>
            @endcan

            @can ('admin')
                <li> {!! link_to('Users', 'users.index', []) !!} </li>
                <li> {!! link_to('Roles', 'roles.index', []) !!} </li>
                <li> {!! link_to('Permissions', 'permissions.index', []) !!} </li>
                <li> <a href="#">Admin Area</a> </li>
                {{-- <li> {!! link_to('Permissions', 'settings.index', []) !!} </li> --}}
            @endcan
        </ul>
    </nav>
</div>
