<?php

namespace musa11971\SortRequest\Traits;

use Illuminate\Foundation\Http\FormRequest;
use musa11971\SortRequest\Exceptions\BadTraitImplementation;
use musa11971\SortRequest\Rules\SortParameter;

trait SortsViaRequest
{
    /**
     * Returns the columns that can be sorted on.
     *
     * @return array
     */
    abstract function getSortableColumns(): array;

    /** @var SortParameter $sortParameterRule */
    private $sortParameterRule;

    /** @noinspection PhpUnhandledExceptionInspection */
    public function __construct()
    {
        if(!($this instanceof FormRequest))
            throw new BadTraitImplementation(__TRAIT__);

        // Create an instance of the validation rule
        $this->sortParameterRule = new SortParameter($this->getSortableColumns());
    }

    /**
     * Returns the validated sorting rules.
     *
     * @return array
     */
    function validatedSortingRules() {
        return $this->sortParameterRule->sortingRules;
    }

    /**
     * Get the validation rules for the sorting.
     *
     * @param string $parameterName
     * @return array
     */
    protected function sortingRules($parameterName = 'sort')
    {
        return [
            $parameterName => [$this->sortParameterRule]
        ];
    }
}
