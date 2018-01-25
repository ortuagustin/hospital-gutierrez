{{ csrf_field() }}

<div class="box">

    <div class="field is-horizontal">

        <div class="field-label">
            <label class="field-label has-text-weight-bold has-text-grey">Patient</label>
        </div>

        <div class="field-body">

            <div class="field">
                <p class="control has-icons-left">
                    <input class="input is-static" type="text" name="patient" value="{{ $patient->full_name }}" readonly>
                    {!! icon('fas fa-user', 'is-small is-left') !!}
                </p>
            </div>

            <label class="field-label has-text-weight-bold has-text-grey">Date</label>

            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="date" name="fecha" value="{{ old('fecha', \Carbon\Carbon::today()->toDateString()) }}" autofocus>
                    {!! icon('fas fa-clock', 'is-small is-left') !!}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'fecha'])
            </div>

        </div>

    </div>

    <div class="field is-horizontal">

        <div class="field-label">
            <label class="field-label has-text-weight-bold has-text-grey">Weight / Height</label>
        </div>

        <div class="field-body">

            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="number" name="peso" value="{{ old('peso') }}" placeholder="The Patient's Weight">
                    {!! icon('fas fa-sort-numeric-up', 'is-small is-left') !!}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'peso'])
            </div>

            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="number" name="talla" value="{{ old('talla') }}" placeholder="The Patient's Height">
                    {!! icon('fas fa-text-height', 'is-small is-left') !!}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'talla'])
            </div>

        </div>

    </div>

    <div class="field is-horizontal">

        <div class="field-label">
            <label class="field-label has-text-weight-bold has-text-grey">Cefalic Percentil</label>
        </div>

        <div class="field-body">

            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="number" name="percentilo_cefalico" value="{{ old('percentilo_cefalico') }}" placeholder="The Patient's Cefalic Percenti">
                    {!! icon('fas fa-sort-numeric-up', 'is-small is-left') !!}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'percentilo_cefalico'])
            </div>

            <label class="field-label has-text-weight-bold has-text-grey">Perimeter</label>

            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="number" name="percentilo_perimetro_cefalico" value="{{ old('percentilo_perimetro_cefalico') }}" placeholder="The Patient's Perimeter Cefalic Percenti">
                    {!! icon('fas fa-text-height', 'is-small is-left') !!}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'percentilo_perimetro_cefalico'])
            </div>

        </div>

    </div>

    <div class="field is-horizontal">

        <div class="field-label">
            <label class="field-label has-text-weight-bold has-text-grey">Examinations</label>
        </div>

        <div class="field-body">

            <div class="field">
                <p class="control">
                    <label class="checkbox has-text-weight-bold has-text-grey">
                        <input type="checkbox" name="vacunas_completas" value="{{ old('vacunas_completas') }}">
                        Vaccines OK?
                    </label>
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'vacunas_completas'])
            </div>

            <div class="field">
                <p class="control">
                    <label class="checkbox has-text-weight-bold has-text-grey">
                        <input type="checkbox" name="maduracion_acorde" value="{{ old('maduracion_acorde') }}">
                        Rippening OK?
                    </label>
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'maduracion_acorde'])
            </div>


            <div class="field">
                <p class="control">
                    <label class="checkbox has-text-weight-bold has-text-grey">
                        <input type="checkbox" name="examen_fisico_normal" value="{{ old('examen_fisico_normal') }}">
                        Physical Test OK?
                    </label>
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'examen_fisico_normal'])
            </div>


        </div>

    </div>

    <div class="field is-horizontal">

        <div class="field-label">
            <label class="field-label has-text-weight-bold has-text-grey">Observations</label>
        </div>

        <div class="field-body">

            <div class="field">
                <p class="control">
                    <textarea name="vacunas_observaciones" rows="5" cols="22" placeholder="Vaccines observations"></textarea> {{ old('vacunas_observaciones') }}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'vacunas_observaciones'])
            </div>

            <div class="field">
                <p class="control">
                    <textarea name="maduracion_observaciones" rows="5" cols="22" placeholder="Rippening observations"></textarea> {{ old('maduracion_observaciones') }}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'maduracion_observaciones'])
            </div>


            <div class="field">
                <p class="control">
                    <textarea name="examen_fisico_observaciones" rows="5" cols="22" placeholder="Physical exam observations"></textarea> {{ old('examen_fisico_observaciones') }}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'examen_fisico_observaciones'])
            </div>

        </div>

    </div>

    <div class="field is-horizontal">

        <div class="field-label">
            <label class="field-label has-text-weight-bold has-text-grey">General Observations</label>
        </div>

        <div class="field-body">

            <div class="field">
                <p class="control">
                    <textarea name="observaciones" rows="10" cols="81"></textarea> {{ old('observaciones') }}
                </p>

                @include('layouts._field_errors', ['errors,' => 'errors', 'field' => 'observaciones'])
            </div>

        </div>

    </div>

</div>

<div class="box">
    <div class="field">
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">
                    {{ $submitButtonText }}
                </button>
            </div>

            <div class="control">
                {!! link_to('Cancel', 'patients.medical_records.index', [$patient], 'button is-danger is-outlined') !!}
            </div>
        </div>
    </div>
</div>
