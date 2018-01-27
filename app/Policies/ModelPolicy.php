<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;

/**
 * Handles Authorization for the Application Models
 * It's RESTful based, so it will check for view, create, update and delete actions
 * The authorization is delegated to the User Permissions.
 * It expect a convention on the Permissions Names: modelName-actionName
 */
abstract class ModelPolicy
{
    use HandlesAuthorization;

    /**
     * The name of the Model that the Policy refers to
     * @var string
     */
    private $modelName = null;

    /**
     * Should return the name of the Model that the Policy handles
     * @return string
     */
    protected function modelName()
    {
        if (is_null($this->modelName)) {
            $reflect = new \ReflectionClass($this);
            $model = str_replace('Policy', '', $reflect->getShortName());
            $this->modelName = Str::plural($model);
        }

        return $this->modelName;
    }

    /**
     * Policy filter that will block every resource action when the application
     * is on maintenance mode, except for admin users
     *
     * @param  \App\User  $user
     * @param string $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if (app()->isDownForMaintenance()) {
            return $user->isAdmin();
        }
    }

    /**
     * Determine whether the User can view the resource.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function index(User $user)
    {
        return $this->view($user);
    }

    /**
     * Determine whether the User can view the resource.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission("{$this->modelName()}-View");
    }

    /**
     * Determine whether the User can create resources.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission("{$this->modelName()}-Create");
    }

    /**
     * Determine whether the User can update the resource.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission("{$this->modelName()}-Update");
    }

    /**
     * Determine whether the User can delete the resource.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission("{$this->modelName()}-Delete");
    }
}
