<?php

namespace HughWilly\Oioubl\Contracts;

use HughWilly\Oioubl\Note;

interface Document
{
    public function addNote(Note $note);

    public function getReferenceData();

    public function addDocumentReference(Document $document, $mutual = false);

    public function attach(Document $document);

    public function render();
}
