<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Provides a method to calculate a Person Age
 */
trait CalculatesAge
{
    /**
     * Returns the age for the person on the given date
     * If $on is null, it will calculate from the $birth_date to the current date
     *
     * @param Carbon      $birth_date
     * @param Carbon|null $on
     * @return int
     */
    public function age(Carbon $birth_date, Carbon $on = null)
    {
        if (is_null($on)) {
            $on = Carbon::today();
        }

        return ($birth_date->diff($on)->y);
    }
}
