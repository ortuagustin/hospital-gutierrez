<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * A Permission may be assigned to many Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * A Permission may be assigned to many Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
