<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
          'key', 'value',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * The "type" of the primary key
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Returns the setting value for the given key
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    public static function value($key, $default = null)
    {
        $setting = static::find($key);

        return is_null($setting) ? $default : $setting->value;
    }
}
