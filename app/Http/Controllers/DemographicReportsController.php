<?php

namespace App\Http\Controllers;

class DemographicReportsController extends ReportsController
{
    /**
     * Display all available reports
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = collect($this->reportsRepository->all());

        return view('reports/demographics/index', compact('reports'));
    }

    /**
     * Returns the JSON data for the specified Report
     *
     * @param  string  $reportName
     *
     * @return \Illuminate\Http\Response
     */
    public function show($reportName)
    {
        return response()->json($this->reportsRepository->getReport($reportName));
    }
}
