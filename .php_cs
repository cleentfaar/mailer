<?php

declare(strict_types=1);

use PhpCsFixer\Config;

$finder = PhpCsFixer\Finder::create()->in([
    'src',
    'tests',
])->exclude([
    'vendor'
]);

return Config::create()->setRules([
    '@Symfony' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'concat_space' => [
        'spacing' => 'one',
    ],
    'psr4' => true,
    'declare_strict_types' => true,
    'linebreak_after_opening_tag' => true,
    'modernize_types_casting' => true,
    'ordered_imports' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_inline_tag' => false,
    'phpdoc_order' => true,
    'ternary_to_null_coalescing' => true,
])->setRiskyAllowed(true)->setFinder($finder);
