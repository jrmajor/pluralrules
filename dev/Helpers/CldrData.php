<?php

namespace Major\PluralRules\Dev\Helpers;

use Psl\Filesystem;
use Psl\Json;

final class CldrData
{
    /**
     * @return array<string, array<string, string>>
     */
    public static function rules(): array
    {
        $data = Filesystem\read_file(__DIR__ . '/../../node_modules/cldr-core/supplemental/plurals.json');

        $rules = Json\decode($data)['supplemental']['plurals-type-cardinal'];

        unset($rules['root']);

        return $rules;
    }
}
