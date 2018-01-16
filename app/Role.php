<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * A Model that represents a User Role
 */
class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['permissions'];

    /**
     * The Users that have this Role assigned
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * A Role can have many Permissions
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
