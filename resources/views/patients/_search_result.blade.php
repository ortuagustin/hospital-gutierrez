<b-collapse class="card" :open="false">
  <div slot="trigger" slot-scope="props" class="card-header">
    <p class="card-header-title">
      <span class="has-text-link is-size-5 is-uppercase">
        <ais-highlight :result="patient" attribute-name="full_name"></ais-highlight>
      </span>
    </p>

    <a class="card-header-icon">
        <b-icon pack="fas" :icon="props.open ? 'angle-up' : 'angle-down'"></b-icon>
    </a>
  </div>

  <div class="card-content">
      <div class="content">
        <p> <b>Document:</b> @{{ patient.doc_type }} -
          <ais-highlight :result="patient" attribute-name="dni"></ais-highlight>
        </p>

        <p> <b>Address:</b><ais-highlight :result="patient" attribute-name="address"></ais-highlight> </p>
        <p> <b>Phone:</b> <ais-highlight :result="patient" attribute-name="phone"></ais-highlight> </p>
        <p> <b>Gender:</b> @{{ patient.gender }} , @{{ patient.age }} years </p>
        <p> <b>Heating Type:</b> @{{ patient.heating_type }} </p>
        <p> <b>Water Type:</b> @{{ patient.water_type }} </p>
        <p> <b>Home Type:</b> @{{ patient.home_type }} </p>
        <p> <b>Medical Insurance:</b> @{{ patient.medical_insurance }} </p>
      </div>
  </div>

  <footer class="card-footer">
    <a :href="patient.path" class="card-footer-item">View</a>
    <a :href="patient.path + '/reports'" class="card-footer-item">Reports</a>

    @can ('view', \App\MedicalRecord::class)
      <a :href="patient.path + '/medical_records'" class="card-footer-item">Medical Records</a>
    @endcan

    @can ('update', \App\Patient::class)
        <a :href="patient.path + '/edit'" class="card-footer-item">Edit</a>
    @endcan
  </footer>
</b-collapse>