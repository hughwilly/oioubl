<?php

namespace HughWilly\Oioubl\Exceptions;

class InvalidDocumentTypeException extends \Exception
{
    public function __construct($documentType)
    {
        parent::__construct(sprintf('Invalid document type: %s', $documentType));
    }
}
