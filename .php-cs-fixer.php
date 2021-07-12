<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->ignoreVCS(true);

return Major\CS\config($finder, [
    // Re-enable one https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/5797 is merged
    'no_break_comment' => false,
    'single_import_per_statement' => false,
    'phpdoc_summary' => false,
    // Remove throw, broken when using throw expressions inline after ?: or ??.
    'no_extra_blank_lines' => [
        'tokens' => ['break', 'case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block', 'switch', 'use'],
    ],
]);
