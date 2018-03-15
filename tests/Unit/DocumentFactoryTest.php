<?php

namespace HughWilly\OioublTests\Unit;

use HughWilly\Oioubl\CreditNote;
use HughWilly\Oioubl\DocumentFactory;
use HughWilly\Oioubl\Invoice;
use HughWilly\Oioubl\Note;
use HughWilly\Oioubl\UtilityStatement;
use HughWilly\OioublTests\TestCase;

class DocumentFactoryTest extends TestCase
{
    public function documentTypeProvider()
    {
        return [
            [Invoice::class],
            [UtilityStatement::class],
            [CreditNote::class],
        ];
    }

    /**
     * @dataProvider documentTypeProvider
     */
    public function testMake($documentType)
    {
        $document = DocumentFactory::make($documentType);

        $this->assertInstanceOf($documentType, $document);
    }

    /**
     * @expectedException \HughWilly\Oioubl\Exceptions\InvalidDocumentTypeException
     */
    public function testMakeThrowsExceptionIfInvalidDocumentType()
    {
        DocumentFactory::make('Foo\\Bar');
    }
}
