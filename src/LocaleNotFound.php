<?php

namespace Major\PluralRules;

use Exception;

class LocaleNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct('Locale not found.');
    }
}
