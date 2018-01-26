<?php

namespace App\Http\Controllers;

use App\ApplicationSetting;
use App\Http\Requests\StoreApplicationSettingRequest;

/**
 * Handles request related to ApplicationSetting model.
 */
class AdminAreaController extends Controller
{
    /**
     * Show the settings page view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = ApplicationSetting::all();
        
        return view('admin/index', compact('settings'));
    }

    /**
     * Show the form for creating a new ApplicationSetting
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/create');
    }

    /**
     * Store a newly created ApplicationSetting in storage.
     *
     * @param  StoreApplicationSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplicationSettingRequest $request)
    {
        $request->save();

        return redirect()->route('admin.index');
    }
}
