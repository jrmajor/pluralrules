<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->append(['gen'])
    ->ignoreVCSIgnored(true);

return Major\CS\config($finder, [
    'no_unneeded_control_parentheses' => false,
    'phpdoc_summary' => false,
    'single_import_per_statement' => [
        'group_to_single_imports' => false,
    ],
    'strict_comparison' => false,
])->setCacheFile('.cache/.php-cs-fixer.cache');
