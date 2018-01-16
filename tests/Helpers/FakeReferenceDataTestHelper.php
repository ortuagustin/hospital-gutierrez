<?php

namespace Tests\Helpers;

use App\Models\ReferenceModel;
use Tests\Fakes\FakeReferenceDataRepository;

trait FakeReferenceDataTestHelper
{
    /**
     * Creates an instance of ReferenceModel with the given values
     * @param int $key
     * @param string $value
     * @return ReferenceModel
     */
    public function makeReferenceModel($key, $value)
    {
        return new ReferenceModel($key, $value);
    }

    /**
     * Injects a FakeRepository for the given contract that contains the specified models
     * @param string $contract
     * @param array  $models
     * @return $this
     */
    protected function swapRepository($contract, array $models = [])
    {
        app()->instance($contract, $this->fakeRepository($models));

        return $this;
    }

    /**
     * Creates an instance of a FakeReferenceDataRepository that contains the specified models
     * @param array $models
     * @return FakeReferenceDataRepository
     */
    protected function fakeRepository(array $models = [])
    {
        return new FakeReferenceDataRepository($models);
    }
}
