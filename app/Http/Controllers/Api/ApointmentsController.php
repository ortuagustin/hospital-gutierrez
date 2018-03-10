<?php

namespace App\Http\Controllers\Api;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApointmentsController extends Controller
{
    public function index($date, Request $request)
    {
        $validator = validator(['date' => $date], [
            'date' => 'required|date_format:j-n-Y',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->first(), 422);
        }

        $appointments = Appointment::scheduledAt(Carbon::parse($date))->get();

        return $appointments->map->time;
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $patient = Patient::where('dni', $request->dni)->firstOrFail();

        $appointment = $patient->scheduleAppointment(Carbon::parse($request->date));

        return response()->json($appointment, 200);
    }

    /**
     * Runs the validation rules agains the given Request
     *
     * @param  \Illuminate\Http\Request  $request
     *
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
            'dni'  => 'required|exists:patients,dni',
            'date' => 'required|unique:appointments|appointment_time', ];
    }
}
