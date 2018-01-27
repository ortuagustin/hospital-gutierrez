<?php

namespace App\Http\Controllers;

use App\Permission;

/**
 * Handles request related to the Permission model.
 */
class PermissionsController extends Controller
{
    /**
     * Display a listing of permission
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('name')->paginate(setting('records_per_page', '15'));

        return view('permissions/index', compact('permissions'));
    }
}
