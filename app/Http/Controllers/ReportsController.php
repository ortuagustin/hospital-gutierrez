<?php

namespace App\Http\Controllers;

use App\Contracts\ReportsRepositoryInterface;

/**
 * Handles the System Reports
 */
class ReportsController extends Controller
{
    /**
     * @var ReportsRepositoryInterface
     */
    protected $reportsRepository;

    /**
     * @inheritDoc
     */
    public function __construct(ReportsRepositoryInterface $reports)
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
        $reports = $this->reportsRepository->names();

        return view('reports/index', compact('reports'));
    }

    /**
     * Returns the JSON data for the specified Report
     *
     * @param  string  $reportName
     * @return \Illuminate\Http\Response
     */
    public function show($reportName)
    {
        return response()->json($this->reportsRepository->getReport($reportName));
    }
}
