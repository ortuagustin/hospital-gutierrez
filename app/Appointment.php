<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

/**
 * A Model that represents an Appointment
 */
class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id', 'date',
    ];

    /**
     * The attributes that should be parsed as Carbon Dates
     *
     * @var array
     */
    protected $dates = [
        'date', 'created_at', 'updated_at',
    ];

    /**
     * Returns the time of the Appointment, formatted as hh:mm
     *
     * @return string
     */
    public function getTimeAttribute()
    {
        return $this->date->format('H:i');
    }

    /**
     * Returns date of the Appointment, formatted as dd-mm-yyyy
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->date->format('j-n-Y');
    }

    /**
     * Get the Patient record associated with the Appointment.
     *
     * @return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Scope a query to only include appointments scheduled at a given date
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Carbon\Carbon $date
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeScheduledAt($builder, Carbon $date)
    {
        return $builder->whereDate('date', '=', $date->format('Y-m-d'));
    }

    /**
     * Returns a collection of the times available for appointments at the given date
     *
     * @param \Carbon\Carbon $date
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function available_at(Carbon $date)
    {
        return collect(static::allowed_times())
                    ->diff(static::appointed_times_at($date))
                    ->values();
    }

    /**
     * Returns a collection of the times of the appointments at the given date
     *
     * @param \Carbon\Carbon $date
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function appointed_times_at(Carbon $date)
    {
        return static::scheduledAt($date)->get()->map->time;
    }

    /**
     * Returns an array with the times when appointment are allowed
     *
     * @return array
     */
    public static function allowed_times()
    {
        $times = [];
        for ($i = 8; $i <= 20; $i++) {
            $times[] = sprintf("%02d:00", $i);
            $times[] = sprintf("%02d:30", $i);
        }

        array_pop($times); // 20:30 is not allowed
        
        return $times;
    }

    /**
     * Returns true if the given time is allowed
     * @param Carbon $time
     *
     * @return bool
     */
    public static function is_allowed_time(Carbon $time)
    {
        return in_array($time->format('H:i'), static::allowed_times());
    }
}
