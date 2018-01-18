<?php

namespace App\Contracts\ReferenceDataRepository;

use App\Models\ReferenceModel;

/**
 * Parses JSON representation of ReferenceModel
 */
trait ParsesJsonIntoReferenceModel
{
    /**
     * Parses the response, returning an array with the ReferenceModels
     * @param string $body JSON representation of a collection of ReferenceModels
     * @return array
     */
    public function parseResponse($body)
    {
        $answer = [];
        foreach (json_decode($body) as $each) {
            $answer[] = new ReferenceModel($each->{'id'}, $each->{'nombre'});
        }

        return $answer;
    }
}
