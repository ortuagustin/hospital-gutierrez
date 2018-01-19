<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

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
        $permissions = Permission::all();

        return view('permissions/index', compact('permissions'));
    }

    /**
     * Show the form for creating a new Permission
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = new Permission();

        return view('permissions/create', compact('permission'));
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        Permission::create($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Show the form for editing the specified Permission
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions/edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validateRequest($request);
        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);

        return redirect()->route('permissions.index');
    }

    /**
     * Runs the validation rules agains the given Request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateRequest(Request $request)
    {
        return $this->validate($request, $this->getValidationRules());
    }

    /**
     * Returns an array with the rules that the validator should use when executed
     *
     * @return array
     */
    protected function getValidationRules()
    {
        return [
            'name' => 'required|string|unique:permissions',
        ];
    }
}
