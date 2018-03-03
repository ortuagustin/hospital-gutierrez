<?php

namespace Tests\Unit;

use App\Models\ReferenceModel;
use App\Repositories\DocTypesRepository;

class ReferenceApiRepository extends TestCase
{
    /**
     * The repository under test
     * @var array
     */
    protected $repository;

    /**
     * Sample JSON response with one element
     * @var string
     */
    protected $one_element_json = '[{"id":"1","nombre":"DNI"}]';

    /**
     * Sample JSON response with many elements
     * @var string
     */
    protected $many_elements_json = '[{"id":"1","nombre":"DNI"},{"id":"2","nombre":"LC"},{"id":"3","nombre":"CI"},{"id":"4","nombre":"LE"}]';

    /** @test */
    public function it_parses_json_into_array()
    {
        $models = $this->repository->parseResponse($this->one_element_json);
        $this->assertTrue(is_array($models), 'It should return an array');
    }

    /** @test */
    public function it_parses_one_json_object_into_array_with_one_element()
    {
        $models = $this->repository->parseResponse($this->one_element_json);
        $this->assertCount(1, $models, 'It should contain one element');
    }

    /** @test */
    public function it_parses_many_json_object_into_array_with_many_elements()
    {
        $models = $this->repository->parseResponse($this->many_elements_json);
        $this->assertCount(4, $models, 'It should contain four elements');
    }

    /** @test */
    public function it_returns_array_wih_reference_model_objects()
    {
        $models = $this->repository->parseResponse($this->one_element_json);
        $this->assertInstanceOf(ReferenceModel::class, $models[0]);
    }

    /** @test */
    public function it_parses_json_object_fields_into_reference_model_fields()
    {
        $model = $this->repository->parseResponse($this->one_element_json)[0];
        $this->assertEquals(1, $model->id());
        $this->assertEquals(1, $model->key());
        $this->assertEquals('DNI', $model->value());
    }

    /** @before */
    protected function setUpEnviroment()
    {
        $this->repository = new DocTypesRepository();
    }
}
