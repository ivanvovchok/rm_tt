<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/public',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return new Config()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PHP80Migration:risky' => true,
        'strict_param' => true,
        'declare_strict_types' => true,
        'no_unused_imports' => true,
        'binary_operator_spaces' => [
            'operators' => ['=>' => 'align', '=' => 'align'],
        ],
        'array_syntax' => ['syntax' => 'short'],
        'single_quote' => true,
        'no_extra_blank_lines' => true,
        'no_superfluous_phpdoc_tags' => true,
        'phpdoc_order' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');
