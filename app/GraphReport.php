<?php

namespace App;

use \JsonSerializable;

/**
 *  Represents a Graph Report
 */
class GraphReport implements JsonSerializable
{
    /**
     * The name of the Report
     * @var string
     */
    private $name;

    /**
     * Labels that the report will display
     * @var array
     */
    public $labels = [];

    /**
     * Every data object that the report will display should be in this datasets array
     * @var array
     */
    public $datasets = [];

    /**
     * Options to customize the chart
     * @var array
     */
    public $options = [];

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the name of the report
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Returns a route to the graph
     */
    public function endpoint()
    {
        return route('reports.show', $this->name(), false);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'chart' => [
                'labels'   => $this->labels,
                'datasets' => $this->datasets,
            ],

            'options'  => $this->options,
        ];
    }
}
