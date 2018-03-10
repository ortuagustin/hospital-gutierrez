<?php

namespace App\Http\Controllers\Api;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
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

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'date'       => Carbon::parse($request->date),
        ]);

        return response()->json($appointment, 200);
    }
}
