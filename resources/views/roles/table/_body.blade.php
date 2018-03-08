@foreach ($roles as $role)
    <tr is="vue-table-row">
        <th>{{ $role->id }}</th>
        <td>{{ $role->name }}</td>
        <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'roles.show', $role->id, '', 'has-text-info') !!} </td>
        <td> {!! link_to_with_icon('fas fa-edit fa-2x', 'roles.edit', $role, '', 'has-text-dark') !!} </td>

        <td>
            <delete-button
                route="{{route('roles.destroy', $role) }}"
                :removes-parent-on-delete="true"
                flash-message="Role deleted!"
                prompt-title="Are you sure?"
                prompt-message="This will delete the Role"
            >
            </delete-button>
        </td>
    </tr>
@endforeach