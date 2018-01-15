<?php

namespace Tests\Helpers;

/**
 * Adds useful methods to Tests Models
 * It's mandatory that the class that uses this trait imlpements the modelUnderTestClass() method
 * and a factory should be defined in ModelFactory.
 */
trait TestsModel
{
    /**
     * Returns a Model Factory for the Model
     * @return \Illuminate\Database\Eloquent\Factory
     */
    protected function modelFactory()
    {
        return factory($this->modelUnderTestClass());
    }

    /**
     * Returns an associative array with the fields of the Model
     * The array will contain the field name as the key, and random data as the value
     * You can override the values of a field passing an associative array, ie ['name' => 'your-value', 'last_name', => 'other-value', ...]
     * @param array $overrides
     * @return array
     */
    protected function modelFields(array $overrides = [])
    {
        return $this->modelFactory()->raw($overrides);
    }

    /**
     * Saves a new Model to the database and returns it
     * @param array $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function createModel(array $overrides = [])
    {
        return $this->modelFactory()->create($overrides);
    }

    /**
     * Creates a new Model and returns it. Does NOT save it to the database
     * @param array $overrides
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function makeModel(array $overrides = [])
    {
        return $this->modelFactory()->make($overrides);
    }
}
