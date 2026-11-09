<?php

namespace Major\PluralRules\Dev\Helpers;

use Psl\File;
use Psl\Json;
use Psl\Type;

final class CldrData
{
    /**
     * @return array<string, array<string, string>>
     */
    public static function rules(): array
    {
        $data = File\read(__DIR__ . '/../../node_modules/cldr-core/supplemental/plurals.json');

        $rules = Json\typed($data, Type\shape([
            'supplemental' => Type\shape([
                'plurals-type-cardinal' => Type\dict(
                    Type\string(),
                    Type\dict(Type\string(), Type\string()),
                ),
            ], true),
        ], true))['supplemental']['plurals-type-cardinal'];

        unset($rules['und']);

        return $rules;
    }
}
