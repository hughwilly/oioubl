<?php

namespace HughWilly\OioublTests\Unit;

use Carbon\Carbon;
use HughWilly\Oioubl\CreditNote;
use HughWilly\Oioubl\DocumentFactory;
use HughWilly\Oioubl\Invoice;
use HughWilly\Oioubl\UtilityStatement;
use HughWilly\OioublTests\TestCase;

class DocumentTest extends TestCase
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
    public function testGetReferenceData($documentType)
    {
        $document = DocumentFactory::make($documentType, [
            'ID' => 1,
            'IssueDate' => $today = Carbon::today()->toDateString(),
        ]);

        $this->assertEquals(1, $document->getReferenceData()['ID']);
        $this->assertNull($document->getReferenceData()['UUID']);
        $this->assertEquals($today, $document->getReferenceData()['IssueDate']);
        $this->assertEquals(class_basename($documentType), $document->getReferenceData()['DocumentTypeCode']);
    }

    /**
     * @expectedException \HughWilly\Oioubl\Exceptions\InvalidDocumentTypeException
     */
    public function testMakeThrowsExceptionIfInvalidDocumentType()
    {
        DocumentFactory::make('Foo\\Bar');
    }
}
