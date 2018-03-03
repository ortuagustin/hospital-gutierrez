<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientsSearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return Patient::search($request['q'])->paginate(setting('records_per_page', '15'));
        }

        return view('patients/search');
    }
}
