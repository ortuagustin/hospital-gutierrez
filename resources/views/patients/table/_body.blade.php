@foreach ($patients as $patient)
    <tr is="vue-table-row">
        <th>{{ $patient->id }}</th>
        <td v-pre>{{ $patient->name }}</td>
        <td v-pre>{{ $patient->last_name }}</td>
        <td v-pre>{{ $patient->document }}</td>
        <td v-pre>{{ $patient->birth_date->toDateString() }}</td>
        <td v-pre>{{ $patient->medicalInsurance->value() }}</td>
        <td v-pre>{{ $patient->address }}</td>
        <td v-pre>{{ $patient->phone }}</td>
        <td>{!! link_to_with_icon('fas fa-info-circle fa-2x', 'patients.show', $patient->id, '', 'has-text-info') !!}</td>
        <td>{!! link_to_with_icon('fas fa-chart-line fa-2x', 'patients.reports', $patient->id, '', 'has-text-success') !!}</td>

        @can ('update', $patient)
            <td>{!! link_to_with_icon('fas fa-edit fa-2x', 'patients.edit', $patient, '', 'has-text-dark') !!}</td>
        @endcan

        @can ('delete', $patient)
            <td>
                <delete-button
                    route="{{route('patients.destroy', $patient) }}"
                    :removes-parent-on-delete="true"
                    flash-message="Patient deleted!"
                    prompt-title="Are you sure?"
                    prompt-message="This will delete the Patient and all of it's Medical Records"
                >
                </delete-button>
            </td>
        @endcan
    </tr>
@endforeach