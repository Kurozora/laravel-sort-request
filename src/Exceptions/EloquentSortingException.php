<?php

namespace musa11971\SortRequest\Exceptions;

use Exception;

class EloquentSortingException extends Exception {
    public function __construct($message)
    {
        parent::__construct($message);
    }
}