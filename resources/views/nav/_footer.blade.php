<div class="hero-foot">
    <nav class="tabs is-centered is-large">
        <ul>
            @can ('view', \App\Patient::class)
                <li> {!! link_to('Patients', 'patients.index', []) !!} </li>
            @endcan

            @can ('admin', \App\Role::class)
                <li> {!! link_to('Roles', 'roles.index', []) !!} </li>
                <li> {!! link_to('Permissions', 'permissions.index', []) !!} </li>
            @endcan
        </ul>
    </nav>
</div>
