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

        $data = [
            'appointment' => $appointment,
            'message'     => $this->appointedMessage($appointment, $request->dni),
        ];

        return response()->json($data, 200);
    }

    /**
     * Returns a message confirming that the appointment was succesful
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $dni
     *
     * @return string
     */
    protected function appointedMessage(Appointment $appointment, $dni)
    {
        return "Te confirmamos el turno nro $appointment->id para $dni, a las $appointment->time del dia $appointment->formatted_date";
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
