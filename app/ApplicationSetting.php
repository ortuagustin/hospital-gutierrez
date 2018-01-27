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

    /**
     * Creates the ApplicationSetting if it does not exist; otherwise, updates the value
     *
     * @param string $key
     * @param string $value
     * @return \App\ApplicationSetting
     */
    public static function put($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['key' => $key, 'value' => $value]
        );
    }

    /**
     * Returns true if a setting with the given key exists; false otherwise
     *
     * @param string $key
     * @return bool
     */
    public static function exists($key)
    {
        return ! (static::missing($key));
    }

    /**
     * Returns true if a setting with the given key does NOT exists; false otherwise
     *
     * @param string $key
     * @return bool
     */
    public static function missing($key)
    {
        return is_null(static::find($key));
    }

    /**
     * Returns the humanized name of the setting.
     * It will remove underscores, and dashes, and capitalize the key
     *
     * @return string
     */
    public function human_name()
    {
        return str_replace(['_', '-'], ' ', title_case($this->key));
    }

    /**
     * Returns the humanized name of the setting.
     * It will remove underscores, and dashes, and capitalize the key
     *
     * @return string
     */
    public function getHumanNameAttribute()
    {
        return $this->human_name();
    }
}
