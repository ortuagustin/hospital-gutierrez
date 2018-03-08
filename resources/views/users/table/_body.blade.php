@foreach ($users as $user)
    <tr is="vue-table-row">
        <th>{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->roles_names() }}</td>
        <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'users.show', $user->id, '', 'has-text-info') !!} </td>

        @if (Auth::id() != $user->id)
            <td>
                <delete-button
                    route="{{route('users.destroy', $user) }}"
                    :removes-parent-on-delete="true"
                    flash-message="User deleted!"
                    prompt-title="Are you sure?"
                    prompt-message="This will delete the User from the system"
                >
                </delete-button>
            </td>
        @endif
    </tr>
@endforeach