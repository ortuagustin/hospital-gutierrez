<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

/**
 * Handles request related to the Patient model.
 */
class PatientsController extends Controller
{
    /**
     * Display a listing of patient
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();

        return view('patients/index', compact('patients'));
    }

    /**
     * Show the form for creating a new Patient
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients/create');
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        Patient::create($request->all());

        return redirect()->route('patients.index');
    }

    /**
     * Display the specified Patient
     *
     * @param  Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('patients/show', compact('patient'));
    }

    /**
     * Show the form for editing the specified Patient
     *
     * @param  Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patients/edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $this->validateRequest($request);
        $patient->update($request->all());

        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::destroy($id);

        return redirect()->route('patients.index');
    }

    /**
     * Runs the validation rules agains the given Request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateRequest(Request $request)
    {
        return $this->validate($request, $this->getValidationRules());
    }

    /**
     * Returns an array with the rules that the validator should use when executed
     *
     * @return array
     */
    protected function getValidationRules()
    {
        return [
          'doc_type_id'          => 'required|',
          'home_type_id'         => 'required|',
          'heating_type_id'      => 'required|',
          'water_type_id'        => 'required|',
          'medical_insurance_id' => 'required|',
          'name'                 => 'required|',
          'last_name'            => 'required|',
          'dni'                  => 'required|',
          'birth_date'           => 'required|',
          'gender'               => 'required|',
          'address'              => 'required|',
          'phone'                => 'required|',
          'has_refrigerator'     => 'required|',
          'has_electricity'      => 'required|',
          'has_pet'              => 'required|',
        ];
    }
}
