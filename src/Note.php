<?php

namespace HughWilly\Oioubl;

class Note
{
    private $text;

    private $languageId;

    public function __construct($text, $languageId = 'en')
    {
        $this->text = $text;
        $this->languageId = $languageId;
    }

    public static function make($text, $languageId = 'en')
    {
        return new static($text, $languageId);
    }

    public function language()
    {
        return $this->languageId;
    }

    public function __toString()
    {
        return $this->text;
    }
}
