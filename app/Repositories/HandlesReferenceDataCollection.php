<?php

namespace App\Contracts\ReferenceDataRepository;

use App\Models\ReferenceModel;

 /**
  * Provides implementation for ReferenceDataRepositoryInterface
  * given a class that only implements the all() method
  */
trait HandlesReferenceDataCollection
{
    /**
     * Returns wether the given key exists in the Repository
     * @param int $key
     * @return bool
     */
    public function contains($key)
    {
        return $this->all()->has($key);
    }

    /**
     * Returns wether the given key exists in the Repository
     * @param int $key
     * @return ReferenceModel
     */
    public function get($key)
    {
        return $this->all()->get($key);
    }
}
