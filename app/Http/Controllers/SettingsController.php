<?php

namespace App\Http\Controllers;

use App\ApplicationSetting;
use App\Contracts\DefaultApplicationSettingsInterface;
use App\Http\Requests\StoreApplicationSettingRequest;
use Illuminate\Http\Request;

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
    public function index(Request $request)
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
        $setting = $request->save();

        if (request()->wantsJson()) {
            if ($setting->reloads) {
                $this->flash("Updated $setting->human_name");
            }

            return response()->json(['Updated succesfuly']);
        }

        return redirect(route('settings.index'));
    }

    /**
     * Resets all settings to default values
     *
     * @param DefaultApplicationSettingsInterface $default_settings
     * @return \Illuminate\Http\Response
     */
    public function reset(DefaultApplicationSettingsInterface $default_settings)
    {
        $default_settings->resetToDefault();

        $this->flash('All settings reset to defaults!');

        if (request()->wantsJson()) {
            return response()->json(['All settings reset to defaults!']);
        }

        return redirect('settings.index');
    }
}
