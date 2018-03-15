<?php

namespace HughWilly\Oioubl;

use HughWilly\Oioubl\Contracts\Document as DocumentContract;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\View;

abstract class Document implements DocumentContract
{
    protected $attachments = [];

    protected $data = [
        'AdditionalDocumentReference' => [],
        'Note' => [],
    ];

    public function __construct(array $data = [])
    {
        $this->data = array_merge($this->data, $data);
    }

    public function addNote(Note $note)
    {
        if (! in_array($note, $this->data['Notes']))
        $this->data['Notes'][] = $note;

        return $this;
    }

    public function addDocumentReference(DocumentContract $document, $mutual = false)
    {
        $this->data['AdditionalDocumentReference'][] = $document->getReferenceData();

        if ($mutual) {
            $document->addDocumentReference($this);
        }

        return $this;
    }

    public function attach(DocumentContract $document)
    {
        if (! in_array($document, $this->attachments())) {
            $this->attachments[] = $document;
        }

        return $this;
    }

    public function getReferenceData()
    {
        return [
            'ID' => array_get($this->data, 'ID'),
            'UUID' => array_get($this->data, 'UUID'),
            'IssueDate' => array_get($this->data, 'IssueDate'),
            'DocumentTypeCode' => $this->documentType(),
        ];
    }

    public function render()
    {
        return view($this->template(), $this->data)->render();
    }

    public function template()
    {
        return sprintf('oioubl::%s', snake_case($this->documentType()));
    }

    public function documentType()
    {
        return class_basename(get_class($this));
    }

    public function attachments()
    {
        return $this->attachments;
    }

    public function notes()
    {
        return $this->data['Notes'];
    }

    public function __toString()
    {
        return $this->render();
    }
}
