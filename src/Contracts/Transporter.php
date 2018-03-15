<?php

namespace HughWilly\Oioubl\Contracts;

interface Transporter
{
    /**
     * Dispatch document.
     *
     * @param Document $document
     *
     * @return bool
     */
    public function dispatch(Document $document);
}
