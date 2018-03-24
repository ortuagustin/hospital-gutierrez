<?php

namespace App;

use App\Contracts\AppointmentsApiInterface;
use Carbon\Carbon;

class AppointmentsApi implements AppointmentsApiInterface
{
    public function available_at($date)
    {
        $validator = validator(['date' => $date], [
            'date' => 'required|date_format:j-n-Y',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->first(), 422);
        }

        return response()->json(Appointment::available_at(Carbon::parse($date)), 200);
    }

    public function schedule($dni, $date)
    {
        $date = Carbon::parse($date);

        $validator = validator(['dni' => $dni, 'date' => $date], [
            'dni'  => 'required|exists:patients,dni',
            'date' => 'required|unique:appointments|appointment_time',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], 422);
        }

        $patient = Patient::where('dni', $dni)->firstOrFail();

        $appointment = $patient->scheduleAppointment($date);

        $data = [
            'appointment' => $appointment,
            'message'     => $this->appointedMessage($appointment, $dni),
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
        return "Scheduled Appointment # $appointment->id for Patient $dni, at $appointment->formatted_date $appointment->time";
    }
}
