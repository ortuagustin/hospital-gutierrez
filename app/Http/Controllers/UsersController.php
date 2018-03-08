<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;

/**
 * Handles request related to the User model.
 */
class UsersController extends Controller
{
    /**
     * Display a listing of user
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(setting('records_per_page', '15'));

        return view('users/index', compact('users'));
    }

    /**
     * Display the specified User
     *
     * @param  User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();

        return view('users/show', compact('user', 'roles'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        if (request()->wantsJson()) {
            return response()->json(['Deleted succesfuly']);
        }

        return redirect()->route('users.index');
    }
}
