<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicalRecordRequest;
use App\MedicalRecord;
use App\Patient;

/**
 * Handles request related to the MedicalRecord model.
 */
class MedicalRecordsController extends Controller
{
    /**
     * Display a listing of the Medical Records of the given Patient
     *
     * @param Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $medicalRecords = $patient->medicalRecords;

        return view('medical_records/index', compact('medicalRecords'));
    }

    /**
     * Show the form for creating a new Medical Record for the given Patient
     *
     * @param int $patient_id
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {
        return view('medical_records/create', compact('patient_id'));
    }

    /**
     * Store a newly created Medical Record in storage
     *
     * @param int $patient_id
     * @param  \App\Http\Requests\StoreMedicalRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($patient_id, StoreMedicalRecordRequest $request)
    {
        $request->save();

        return redirect()->route('medical_records.index', $patient_id);
    }

    /**
     * Display the specified Medical Record
     *
     * @param int $patient_id
     * @param  MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id, MedicalRecord $medicalRecord)
    {
        return view('medical_records/show', compact('medicalRecord'));
    }

    /**
     * Show the form for editing the specified Medical Record
     *
     * @param int $patient_id
     * @param  MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($patient_id, MedicalRecord $medicalRecord)
    {
        return view('medical_records/edit', compact('medicalRecord'));
    }

    /**
     * Update the specified Medical Record in storage
     *
     * @param int $patient_id
     * @param  \App\Http\Requests\StoreMedicalRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($patient_id, StoreMedicalRecordRequest $request)
    {
        $request->save();

        return redirect()->route('medical_records.index', $patient_id);
    }

    /**
     * Remove the specified MedicalRecord from storage.
     *
     * @param int $patient_id
     * @param  MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($patient_id, MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return redirect()->route('medical_records.index', $patient_id);
    }
}
