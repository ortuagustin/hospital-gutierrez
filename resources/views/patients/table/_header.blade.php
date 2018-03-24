<tr>
    <th><abbr title="Number">#</abbr></th>
    <th>Name</th>
    <th>Last Name</th>
    <th>Identification</th>
    <th>Birth Date</th>
    <th>Medical Insurance</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Details</th>
    <th>Reports</th>

    @can ('update', \App\Patient::class)
        <th>Edit</th>
    @endcan

    @can ('delete', \App\Patient::class)
        <th>Delete</th>
    @endcan
</tr>