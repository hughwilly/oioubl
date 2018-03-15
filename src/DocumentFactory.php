<?php

namespace HughWilly\Oioubl;

use HughWilly\Oioubl\Exceptions\InvalidDocumentTypeException;
use Illuminate\Support\Facades\View;

class DocumentFactory
{
    /**
     * @param string $documentType
     * @param array $data
     *
     * @return \HughWilly\Oioubl\Contracts\Document
     *
     * @throws InvalidDocumentTypeException
     */
    public static function make($documentType, array $data = [])
    {
        if (! class_exists($documentType)) {
            throw new InvalidDocumentTypeException($documentType);
        }

        return new $documentType($data);
    }
}
