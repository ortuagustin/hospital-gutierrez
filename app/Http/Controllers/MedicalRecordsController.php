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
     * @inheritDoc
     */
    public function __construct()
    {
        // need to pass the snake_cased class name
        // see https://github.com/laravel/framework/issues/18432
        $this->authorizeResource(MedicalRecord::class, 'medical_record');
    }

    /**
     * Display a listing of the Medical Records of the given Patient
     *
     * @param Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $medical_records = $patient->medicalRecords;

        return view('medical_records/index', compact('medical_records', 'patient'));
    }

    /**
     * Show the form for creating a new Medical Record for the given Patient
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view('medical_records/create', compact('patient'));
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
     * @param  Patient $patient
     * @param  MedicalRecord  $medical_record
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, MedicalRecord $medical_record)
    {
        return view('medical_records/show', compact('medical_record', 'patient'));
    }

    /**
     * Remove the specified MedicalRecord from storage.
     *
     * @param int $patient_id
     * @param  MedicalRecord  $medical_record
     * @return \Illuminate\Http\Response
     */
    public function destroy($patient_id, MedicalRecord $medical_record)
    {
        $medical_record->delete();

        return redirect()->route('medical_records.index', $patient_id);
    }
}
