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

        /** @phpstan-ignore offsetAccess.nonOffsetAccessible, offsetAccess.nonOffsetAccessible */
        $rules = Json\decode($data)['supplemental']['plurals-type-cardinal'];

        Type\dict(
            Type\string(),
            Type\dict(Type\string(), Type\string()),
        )->assert($rules);

        unset($rules['und']);

        return $rules;
    }
}
