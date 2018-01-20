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
     * @param int $id
     * @return bool
     */
    public function contains($id)
    {
        return $this->all()->contains(function ($value, $key) use ($id) {
            return $value->key() == $id;
        });
    }

    /**
     * Returns wether the given key exists in the Repository
     * @param int $id
     * @return ReferenceModel
     */
    public function get($id)
    {
        return $this->all()->first(function ($value, $key) use ($id) {
            return $value->key() == $id;
        });
    }
}
