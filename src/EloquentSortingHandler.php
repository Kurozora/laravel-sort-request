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

    public function __construct($request, $builder)
    {
        $this->request = $request;
        $this->builder = $builder;
    }

    /**
     * Handles the actual Eloquent sorting and returns the builder.
     *
     * @return Builder
     * @throws EloquentSortingException
     */
    function handle() {
        // Check whether the request uses the trait
        if(!method_exists($this->request, 'validatedSortingRules')) {
            $requestClass = get_class($this->request);

            throw new EloquentSortingException("{$requestClass} is not using the SortsViaRequest trait.");
        }

        // Get the rules from the request
        $rules = $this->request->validatedSortingRules();

        foreach($rules as $rule) {
            $this->builder->orderBy($rule['column'], $rule['direction']);
        }

        // Pass back the builder so that it can be chained
        return $this->builder;
    }
}