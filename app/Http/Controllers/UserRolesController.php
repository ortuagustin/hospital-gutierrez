<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;

/**
 * Handles request related to the User<-->Role relationship.
 */
class UserRolesController extends Controller
{
    /**
     * Removes the given Role from the User
     * @param User $user
     * @param Role $role
     */
    public function destroy(User $user, Role $role)
    {
        $user->roles()->detach($role);

        return redirect()->route('users.show', $user);
    }
}
