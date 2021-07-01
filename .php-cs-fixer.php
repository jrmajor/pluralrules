<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->ignoreVCS(true);

return Major\CS\config($finder, [
    'single_import_per_statement' => false,
    'phpdoc_summary' => false,
]);
