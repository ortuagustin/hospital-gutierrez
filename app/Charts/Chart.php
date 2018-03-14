<?php

namespace App\Charts;

use \JsonSerializable;

/**
 *  Represents a Chart Report
 */
abstract class Chart implements JsonSerializable
{
    /**
     * The name of the Chart
     *
     * @var string
     */
    private $name = null;

    /**
     * Wether the chart is responsive or not (on rendering)
     *
     * @var boolean
     */
    protected $isResponsive = false;

    /**
     * Labels that the chart will display
     *
     * @return array
     */
    abstract protected function labels();

    /**
     * Data that the chart will display
     *
     * @return array
     */
    abstract protected function data();

    /**
     * Returns a route to the chart
     */
    public function endpoint()
    {
        return route('reports.show', $this->name(), false);
    }

    /**
     * The name of the chart
     *
     * @return string
     */
    public function name()
    {
        if (is_null($this->name)) {
            $reflect = new \ReflectionClass($this);
            $this->name = kebab_case(str_replace('Chart', '', $reflect->getShortName()));
        }

        return $this->name;
    }

    /**
     * The title of the chart
     *
     * @return string
     */
    public function title()
    {
        return title_case(str_replace('-', ' ', $this->name()));
    }

    /**
     * Options to customize the chart
     *
     * @return array
     */
    public function options()
    {
        return [
            'responsive'  => $this->isResponsive,
        ];
    }

    /**
     * Dataset that the chart will display
     *
     * @return array
     */
    protected function datasets()
    {
        return [
            [
                'data'            => $this->data(),
                'backgroundColor' => $this->backgroundColours(count($this->labels())),
            ],
        ];
    }

    /**
     * Returns an array where each element is a colour for each label
     *
     * @param int $labelCount
     *
     * @return array
     */
    protected function backgroundColours($labelCount)
    {
        $colours = Colours::all();
        shuffle($colours);

        return array_slice($colours, 0, $labelCount);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'chart' => [
                'labels'   => $this->labels(),
                'datasets' => $this->datasets(),
            ],

            'options'  => $this->options(),
        ];
    }
}
