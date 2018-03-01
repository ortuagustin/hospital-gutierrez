<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

/**
 * Handles request related to the User<-->Role relationship.
 */
class UserRolesController extends Controller
{
    /**
     * Removes the given Role from the User
     *
     * @param User $user
     * @param Role $role
     */
    public function destroy(User $user, Role $role)
    {
        $user->roles()->detach($role);

        return redirect()->route('users.show', $user);
    }

    /**
     * Update the User relationship with the given roles
     *
     * @param Request  $request
     * @param User  $user
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        if ($request->wantsJson()) {
            return response(['Roles updated', 201]);
        }

        return redirect()->route('roles.index');
    }
}
