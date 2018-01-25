<div class="box">
    {{ $slot }}
    <p> <strong>Phone:</strong> {{ $patient->phone }} </p>
    <p> <strong>Address:</strong> {{ $patient->address }} </p>
    <p> <strong>Document:</strong> {{ $patient->document }} </p>
    <p> <strong>Gender:</strong> {{ ucfirst($patient->gender) }} </p>
    <p> <strong>Medical Insurance:</strong> {{ $patient->medicalInsurance->value() }} </p>
    <p> <strong>Birth Date:</strong> {{ $patient->birth_date_with_age }} </p>
</div>
