<?php

namespace HughWilly\Oioubl;

use HughWilly\Oioubl\Exceptions\InvalidSchemaException;
use HughWilly\Oioubl\Exceptions\SchematronValidationException;
use HughWilly\Oioubl\Exceptions\SchemaValidationException;

class Validator
{
    protected $schemas = [
        Invoice::class => [
            'schema' => __DIR__ . '/Schemas/UBL-Invoice-2.0.xsd',
            'schematron' => __DIR__ . '/Schemas/Schematron/OIOUBL_Invoice_Schematron.xsl',
        ],
        CreditNote::class => [
            'schema' => __DIR__ . '/Schemas/UBL-Creditnote-2.0.xsd',
            'schematron' => __DIR__ . '/Schemas/Schematron/OIOUBL_CreditNote_Schematron.xsl',
        ],
        UtilityStatement::class => [
            'schema' => __DIR__ . '/Schemas/UBL-UtilityStatement-2.1.xsd',
            'schematron' => __DIR__ . '/Schemas/Schematron/OIOUBL_UtilityStatement_Schematron.xsl',
        ],
    ];

    /**
     * @param Document $document
     * @param bool $validateAttachments
     *
     * @throws InvalidSchemaException
     * @throws SchemaValidationException
     * @throws \Throwable
     */
    public function validate(Document $document, $validateAttachments = false)
    {
        $dom = new \DOMDocument;
        $dom->loadXML($document->xml());

        $this->schema($dom, array_get($this->schemas, sprintf('%s.schema', class_basename($document))));

        $this->schematron($dom, array_get($this->schemas, sprintf('%s.schematron', class_basename($document))));

        if ($validateAttachments) {
            array_map([$this, 'validate'], $document->attachments());
        }
    }

    /**
     * @param \DOMDocument $dom
     * @param string $schema
     *
     * @throws InvalidSchemaException
     * @throws SchemaValidationException
     */
    protected function schema(\DOMDocument $dom, $schema)
    {
        if (! $schema) {
            throw new InvalidSchemaException($schema);
        }

        if (! $dom->schemaValidate($schema)) {
            throw new SchemaValidationException(libxml_get_last_error()->message);
        }
    }

    /**
     * @param \DOMDocument $dom
     * @param string $schema
     *
     * @throws InvalidSchemaException
     * @throws SchematronValidationException
     */
    protected function schematron(\DOMDocument $dom, $schema)
    {
        if (! $schema) {
            throw new InvalidSchemaException($schema);
        }

        $processor = new \XSLTProcessor;
        $processor->importStylesheet(simplexml_load_file($schema));

        $errors = simplexml_load_string($result = $processor->transformToXml($dom))->xpath('//Error');

        if (count($errors)) {
            throw new SchematronValidationException($errors);
        }
    }
}
