<?php

namespace App\Repositories;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\ReferenceDataRepository\HandlesReferenceDataCollection;
use App\Contracts\ReferenceDataRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use App\Models\ReferenceModel;

/**
 * Repository implementation that consumes a REST web-service
 */
abstract class ReferenceApiRepository implements ReferenceDataRepositoryInterface
{
    use HandlesReferenceDataCollection;

    /**
     * @var string
     */
    private static $default_url = 'https://api-referencias.proyecto2017.linti.unlp.edu.ar/';

    /**
     * The base url of the API that the Repository will send HTTP requests to
     * @var string $url
     */
    protected $url;

    /**
     * @param string $url The base url of the API that the Repository will send HTTP requests to
     * Must include final slash
     * Will default to self::$default_url if empty
     */
    public function __construct($url = '')
    {
        if (empty($url)) {
            $this->url = self::$default_url;
        } else {
            $this - $url = $url;
        }
    }

    public function all()
    {
        $response = file_get_contents("{$this->url}{$this->resource()}");

        return collect($this->parseResponse(json_decode($response)));
    }

    /**
     * Parses the response, returning an array with the ReferenceModels
     * @param array $items
     * @return array
     */
    protected function parseResponse(array $items)
    {
        $answer = [];
        foreach ($items as $each) {
            $answer[] = new ReferenceModel($each->{'id'}, $each->{'nombre'});
        }

        return $answer;
    }

    /**
     * The name of the remote resource
     * Requests will be sent to $this->url\$this->resource()
     */
    abstract protected function resource();
}

class DocTypesRepository extends ReferenceApiRepository implements DocTypesRepositoryInterface
{
    protected function resource()
    {
        return 'tipo-documento';
    }
}

class HomeTypesRepository extends ReferenceApiRepository implements HomeTypesRepositoryInterface
{
    protected function resource()
    {
        return 'tipo-vivienda';
    }
}

class HeatingTypesRepository extends ReferenceApiRepository implements HeatingTypesRepositoryInterface
{
    protected function resource()
    {
        return 'tipo-calefaccion';
    }
}

class WaterTypesRepository extends ReferenceApiRepository implements WaterTypesRepositoryInterface
{
    protected function resource()
    {
        return 'tipo-agua';
    }
}

class MedicalInsurancesRepository extends ReferenceApiRepository implements MedicalInsurancesRepositoryInterface
{
    protected function resource()
    {
        return 'obra-social';
    }
}
