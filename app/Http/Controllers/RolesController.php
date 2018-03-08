<?php

namespace App\Http\Controllers;

use App\Contracts\DefaultAuthSchemaInterface;
use App\Role;
use Illuminate\Http\Request;

/**
 * Handles request related to the Role model.
 */
class RolesController extends Controller
{
    /**
     * Display a listing of role
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name')->paginate(setting('records_per_page', '15'));

        return view('roles/index', compact('roles'));
    }

    /**
     * Show the form for creating a new Role
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();

        return view('roles/create', compact('role'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        Role::create($request->all());

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified Role
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles/show', compact('role'));
    }

    /**
     * Show the form for editing the specified Role
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles/edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validateRequest($request);
        $role->update($request->all());

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);

        if (request()->wantsJson()) {
            return response()->json(['Deleted succesfuly']);
        }

        return redirect()->route('roles.index');
    }

    /**
     * Resets all roles and permissions to default
     *
     * @param DefaultAuthSchemaInterface $auth_schema
     * @return \Illuminate\Http\Response
     */
    public function reset(DefaultAuthSchemaInterface $auth_schema)
    {
        $auth_schema->resetToDefault();

        return redirect()->route('roles.index');
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
            'name' => 'required|string|unique:roles',
        ];
    }
}
