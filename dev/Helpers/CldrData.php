<?php

namespace Major\PluralRules\Dev\Helpers;

use Psl\Filesystem;
use Psl\Json;
use Psl\Type;

final class CldrData
{
    /**
     * @return array<string, array<string, string>>
     */
    public static function rules(): array
    {
        $data = Filesystem\read_file(__DIR__ . '/../../node_modules/cldr-core/supplemental/plurals.json');

        /** @phpstan-ignore-next-line */
        $rules = Json\decode($data)['supplemental']['plurals-type-cardinal'];

        Type\dict(
            Type\string(),
            Type\dict(Type\string(), Type\string()),
        )->assert($rules);

        /** @phpstan-var array<string, array<string, string>> $rules */

        unset($rules['root']);

        return $rules;
    }
}
