<?php

namespace musa11971\SortRequest\Tests\Support\Requests;

use musa11971\SortRequest\Tests\Support\Sorters\ItemWeightSorter;
use musa11971\SortRequest\Traits\SortsViaRequest;

class AdvancedGetItemsRequest extends FormRequest
{
    use SortsViaRequest;

    /**
     * Get the rules that the request enforces.
     *
     * @return array
     */
    function rules()
    {
        return array_merge([
            // .. rules
        ], $this->sortingRules());
    }

    /**
     * Returns the columns that can be sorted on.
     *
     * @return array
     */
    function getSortableColumns(): array
    {
        return [
            'id',
            'weight' => ItemWeightSorter::class
        ];
    }
}