@foreach ($medical_records as $medical_record)
    <tr is="vue-table-row">
        <th> {{ $medical_record->fecha ->toDateString() }}</th>
        <td> {{ $medical_record->patient_age }} </td>
        <td> {{ $medical_record->peso }} </td>
        <td> {{ $medical_record->talla }} </td>
        <th> {{ $medical_record->percentilo_cefalico }} </th>
        <td> {{ $medical_record->percentilo_perimetro_cefalico }} </td>
        <td> {!! centered_check_icon($medical_record->vacunas_completas) !!} </td>
        <td> {!! centered_check_icon($medical_record->maduracion_acorde) !!} </td>
        <td> {!! centered_check_icon($medical_record->examen_fisico_normal) !!} </td>
        <td v-pre> {{ $medical_record->user_name }} </td>

        @can ('view', $medical_record)
            <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'patients.medical_records.show', [$patient, $medical_record], '', 'has-text-info') !!} </td>
        @endcan

        @can ('delete', $medical_record)
            <td>
                <delete-button
                    route="{{route('patients.medical_records.destroy', [$patient, $medical_record]) }}"
                    :removes-parent-on-delete="true"
                    flash-message="Medical Record deleted!"
                    prompt-title="Are you sure?"
                    prompt-message="This will delete the Record"
                >
                </delete-button>
            </td>
        @endcan
    </tr>
@endforeach