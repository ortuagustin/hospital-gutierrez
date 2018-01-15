<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['roles'];

    /**
     * The roles that belong to the User.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Returns True if the User has the given Permission
     * @param Permission|int $permission Can be a Permission Model or the Permission Id
     */
    public function hasPermission($permission)
    {
        $permission_id = $this->permissionId($permission);

        return $this->permissions()->contains(function ($value, $key) use ($permission_id) {
            return $value->id === $permission_id;
        });
    }

    /**
     * Returns True if the User hasn't the given Permission
     * @param Permission|int $permission Can be a Permission Model or the Permission Id
     */
    public function hasNotPermission($permission)
    {
        return ! $this->hasPermission($permission);
    }

    /**
     * Returns all the User Permissions.
     * @return Collection
     */
    public function permissions()
    {
        $permissions = [];
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if (! in_array($permission, $permissions)) {
                    $permissions[] = $permission;
                }
            }
        }

        return collect($permissions);
    }

    /**
     * Returns all the User Permissions.
     * @return Collection
     */
    public function getPermissionsAttribute()
    {
        return $this->permissions();
    }

    /**
     * Returns the Id of the given Permission
     * @param Permission|int $permission Can be a Permission Model or the Permission Id
     */
    protected function permissionId($permission)
    {
        return ($permission instanceof Permission) ? $permission->id : $permission;
    }
}
