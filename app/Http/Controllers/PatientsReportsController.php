<?php

namespace App\Http\Controllers;

use App\Contracts\PatientsReportsRepositoryInterface;
use App\Patient;
use Illuminate\Http\Request;

/**
 * Displays Patients Reports
 */
class PatientsReportsController extends Controller
{
    /**
     * @var PatientsReportsRepositoryInterface
     */
    protected $reportsRepository;

    /**
     * @inheritDoc
     */
    public function __construct(PatientsReportsRepositoryInterface $reports)
    {
        $this->reportsRepository = $reports;
    }

    /**
     * Display all available reports
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = collect($this->reportsRepository->all());

        return view('reports/patients/index', compact('reports'));
    }

    /**
     * Shows the requested report for the given Patient
     *
     * @param  Request  $request
     * @param  Patient  $patient
     * @param  string  $reportName
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Patient $patient, $report)
    {
        return response()->json($this->reportsRepository->getReport($report, $patient));
    }
}
