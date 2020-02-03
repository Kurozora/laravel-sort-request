<?php

namespace musa11971\SortRequest;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use musa11971\SortRequest\Exceptions\EloquentSortingException;

class EloquentSortingHandler {
    /** @var Request $request */
    private $request;

    /** @var Builder $builder */
    private $builder;

    /** @var array $rules */
    private $rules;

    /** @var SortableColumnCollection $sortableColumns */
    private $sortableColumns;

    public function __construct($request, $builder)
    {
        $this->request = $request;
        $this->builder = $builder;

        // Get the rules and sortable columns from the request
        $this->rules = $this->request->validatedSortingRules();
        $this->sortableColumns = $this->request->transformedSortableColumns();
    }

    /**
     * Handles the actual Eloquent sorting and returns the builder.
     *
     * @return Builder
     * @throws EloquentSortingException
     */
    function handle()
    {
        // Check whether the request uses the trait before continuing
        $this->checkForTrait();

        // Loop through every rule and handle it individually
        foreach($this->rules as $rule)
        {
            // Find the relevant sortable column for this rule
            $sortableColumn = $this->sortableColumns->find($rule['column']);

            // If the sortable column is not custom, do a basic orderBy
            if(!$sortableColumn->isCustom) {
                $this->builder->orderBy($rule['column'], $rule['direction']);
            }
            else {
                $this->handleCustomSort($sortableColumn, $rule, $this->builder);
            }
        }

        // Pass back the builder so that it can be chained
        return $this->builder;
    }

    /**
     * Handle the sorting of a custom sortable column.
     *
     * @param SortableColumn $sortableColumn
     * @param array $rule
     * @param Builder $builder
     * @throws EloquentSortingException
     */
    private function handleCustomSort($sortableColumn, $rule, &$builder)
    {
        // Get the method name that needs to be called for the custom sort
        $methodName = $sortableColumn->getSortingMethodName();

        // Check whether the method exists in the request
        if(!method_exists($this->request, $methodName))
            throw new EloquentSortingException("Could not sort custom column '{$sortableColumn->name}', because method: '{$methodName}' is not implemented.");

        // Call the custom sorting method in the request
        $this->request->{$methodName}($rule['direction'], $builder);
    }

    /**
     * Checks whether the request uses the trait.
     *
     * @throws EloquentSortingException
     */
    private function checkForTrait()
    {
        if(!method_exists($this->request, 'validatedSortingRules')) {
            $requestClass = get_class($this->request);

            throw new EloquentSortingException("{$requestClass} is not using the SortsViaRequest trait.");
        }
    }
}