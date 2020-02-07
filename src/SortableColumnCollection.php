<?php

namespace musa11971\SortRequest;

use Illuminate\Support\Collection;

class SortableColumnCollection extends Collection
{
    /**
     * Checks whether the given column name can be sorted on.
     *
     * @param string $column
     * @return bool
     */
    function isValidColumn($column)
    {
        $column = $this->find($column);

        return $column !== null;
    }

    /**
     * Checks whether the given direction is a valid one for the column.
     *
     * @param string $column
     * @param string $direction
     * @return bool
     */
    function isValidDirectionForColumn($column, $direction)
    {
        $column = $this->find($column);

        if($column) {
            return in_array($direction, $column->sorter->getDirections());
        }

        return false;
    }

    /**
     * Returns the SortableColumn with the given name or null if not found.
     *
     * @param $column
     * @return SortableColumn|null
     */
    function find($column)
    {
        foreach($this->items as $item) {
            if($item->name === $column) return $item;
        }

        return null;
    }
}