<tr>
    <th>Date</th>
    <th>Age</th>
    <th>Weight</th>
    <th>Height</th>
    <th>CP</th>
    <th>CPP</th>
    <th>Vaccines?</th>
    <th>Ripening?</th>
    <th>Physical Test?</th>
    <th>User</th>

    @can ('view', \App\MedicalRecord::class)
        <th>Details</th>
    @endcan

    @can ('delete', \App\MedicalRecord::class)
        <th>Delete</th>
    @endcan
</tr>
</tr>