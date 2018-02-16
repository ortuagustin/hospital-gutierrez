<?php

namespace App\Http\Controllers;

use App\Report;

/**
 * Handles the System Reports
 */
class ReportsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->authorizeResource(Report::class);
    }
    
    /**
     * Display all available reports
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();

        return view('reports/index', compact('reports'));
    }

    /**
     * Display the specified Report
     *
     * @param  Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view('reports/show', compact('report'));
    }
}
