<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users/show', compact('user'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('users.index');
    }
}
