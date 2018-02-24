<?php

namespace App\Http\Controllers;

/**
 * Handles the System Reports
 */
class ReportsController extends Controller
{
    /**
     * All the system available Reports
     *
     * @var array
     */
    protected $reports = [];

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->reports = [];
    }

    /**
     * Display all available reports
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports/index', compact('reports'));
    }

    /**
     * Returns the JSON data for the specified Report
     *
     * @param  string  $report
     * @return \Illuminate\Http\Response
     */
    public function show($report)
    {
        return response()->json([
            'labels'   => ["Sleeping", "Designing"],
            'datasets' => [
                [
                    'data'            => [20, 40],
                    'label'           => 'something',
                    'backgroundColor' => '#1fc8db',
                ],
            ],
        ]);
    }
}
