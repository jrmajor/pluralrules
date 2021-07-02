<?php

namespace Major\PluralRules;

use Exception;

class LocaleNotFound extends Exception
{
    public function __construct(string $locale)
    {
        parent::__construct("Plural rules for {$locale} has not been found.");
    }
}
