<?php

namespace App\Http\Controllers;

use App\Contracts\ReportsRepositoryInterface;

abstract class ReportsController extends Controller
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
}
