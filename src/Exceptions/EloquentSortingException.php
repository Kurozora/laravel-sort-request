<?php

namespace kiritokatklian\SortRequest\Exceptions;

use Exception;

class EloquentSortingException extends Exception
{
    /**
     * EloquentSortingException constructor.
     *
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
