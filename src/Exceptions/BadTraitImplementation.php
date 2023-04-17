<?php

namespace kiritokatklian\SortRequest\Exceptions;

use Exception;

class BadTraitImplementation extends Exception
{
    /**
     * BadTraitImplementation constructor.
     *
     * @param $trait
     */
    public function __construct($trait)
    {
        parent::__construct("Trait: '{$trait}' not implemented properly.");
    }
}
