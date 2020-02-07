<?php

namespace musa11971\SortRequest;

use musa11971\SortRequest\Support\Foundation\Contracts\Sorter;

class SortableColumn
{
    public $name;
    public $sorter;

    /**
     * @param string $name
     * @param Sorter $sorter
     */
    public function __construct($name, $sorter)
    {
        $this->name = $name;
        $this->sorter = $sorter;
    }
}