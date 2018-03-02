<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientsSearchController extends Controller
{
    public function index(Request $request)
    {
        $patients = Patient::search($request['q'])->orderBy('name')->paginate(setting('records_per_page', '15'));

        if ($request->wantsJson()) {
            return $patients;
        }

        return view('patients/index', compact('patients'));
    }
}
