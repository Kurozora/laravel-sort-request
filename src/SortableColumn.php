<?php

namespace musa11971\SortRequest;

use Illuminate\Support\Str;

class SortableColumn
{
    public $name;
    public $directions;
    public $isCustom;

    /**
     * @param string $name
     * @param array $directions
     * @param bool $isCustom
     */
    public function __construct($name, $directions, $isCustom)
    {
        $this->name = $name;
        $this->directions = $directions;
        $this->isCustom = $isCustom;
    }

    /**
     * Returns the method name used for sorting, if the column is custom.
     *
     * @return string
     */
    function getSortingMethodName()
    {
        return Str::camel('sort ' . $this->name);
    }
}