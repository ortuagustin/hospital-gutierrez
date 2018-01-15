<?php

namespace Tests\Helpers;

use App\Models\ReferenceModel;

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
}
