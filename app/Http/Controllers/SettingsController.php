<?php

namespace App\Http\Controllers;

use App\ApplicationSetting;
use App\Http\Requests\StoreApplicationSettingRequest;

/**
 * Handles request related to ApplicationSetting model.
 */
class SettingsController extends Controller
{
    /**
     * Show the settings page view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = ApplicationSetting::all();

        return view('settings/index', compact('settings'));
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

        return redirect()->route('settings.index');
    }
}
