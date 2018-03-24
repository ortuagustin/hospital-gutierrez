<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AppointmentsApiInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApointmentsController extends Controller
{
    /** @var AppointmentsApiInterface */
    private $api;

    public function __construct(AppointmentsApiInterface $api)
    {
        $this->api = $api;
    }

    public function index($date)
    {
        return $this->api->available_at($date);
    }

    public function store(Request $request)
    {
        return $this->api->schedule($request->dni, $request->date);
    }
}
