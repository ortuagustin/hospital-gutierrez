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
   * @return Response
   */
    public function index()
    {
        $patients = Patient::all();

        return view('patients/index', compact('patients'));
    }

    /**
     * Show the form for creating a new Patient
     *
     * @return Response
     */
    public function create()
    {
        return view('patients/create');
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = validator($data, Patient::$rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Patient::create($data);

        return redirect()->route('patients.index');
    }

    /**
     * Display the specified Patient
     *
     * @param  Patient  $patient
     * @return Response
     */
    public function show(Patient $patient)
    {
        return view('patients/show', compact('patient'));
    }

    /**
     * Show the form for editing the specified Patient
     *
     * @param  Patient  $patient
     * @return Response
     */
    public function edit(Patient $patient)
    {
        return view('patients/edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Patient  $patient
     * @return Response
     */
    public function update(Request $request, Patient $patient)
    {
        $data = $request->all();
        $validator = validator($data, Patient::$rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $patient->update($data);

        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Patient::destroy($id);

        return redirect()->route('patients.index');
    }
}
