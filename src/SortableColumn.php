<?php

namespace kiritokatklian\SortRequest;

use kiritokatklian\SortRequest\Support\Foundation\Contracts\Sorter;

class SortableColumn
{
    public string $name;
    public Sorter $sorter;

    /**
     * @param string $name
     * @param Sorter $sorter
     */
    public function __construct(string $name, Sorter $sorter)
    {
        $this->name = $name;
        $this->sorter = $sorter;
    }
}
