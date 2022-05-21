<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->ignoreVCSIgnored(true);

return Major\CS\config($finder, [
    'single_import_per_statement' => false,
    'phpdoc_summary' => false,
    'strict_comparison' => false,
])->setCacheFile('.cache/.php-cs-fixer.cache');
