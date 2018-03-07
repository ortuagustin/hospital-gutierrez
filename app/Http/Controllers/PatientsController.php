<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Patient;

/**
 * Handles request related to the Patient model.
 */
class PatientsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->authorizeResource(Patient::class);
    }

    /**
     * Display a listing of patient
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::orderBy('name')->paginate(setting('records_per_page', '15'));

        return view('patients/index', compact('patients'));
    }

    /**
     * Show the form for creating a new Patient
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patient = new Patient();

        return view('patients/create', compact('patient'));
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param  StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientRequest $request)
    {
        $request->save();

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
     * @param  StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StorePatientRequest $request)
    {
        $request->save();

        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param  Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        if (request()->wantsJson()) {
            return response()->json(['Deleted succesfuly']);
        }

        return redirect()->route('patients.index');
    }
}
