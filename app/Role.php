<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * A Rol can have many Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
