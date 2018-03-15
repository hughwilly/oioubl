<?php

namespace HughWilly\Oioubl\Exceptions;

class InvalidSchemaException extends \Exception
{
    public function __construct($schema)
    {
        parent::__construct(sprintf('Invalid schema specified: %s', $schema));
    }
}
