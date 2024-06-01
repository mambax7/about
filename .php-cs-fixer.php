<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true);

$configRules = [
    '@PSR12'                       => true,
    'array_syntax'                 => ['syntax' => 'short'],
    'binary_operator_spaces'       => [
        'default'   => 'align',
        'operators' => ['=>' => 'align', '=' => 'single_space'],
    ],
    'blank_line_after_namespace'   => true,
    'blank_line_after_opening_tag' => true,
    'blank_line_before_statement'  => [
        'statements' => ['return'],
    ],
    'braces'                       => [
        'allow_single_line_closure'     => true,
        'phpdoc_annotation_without_dot' => true, // Avoid adding dots to PhpDoc
        'no_leading_import_slash'       => false, // Keep leading backslashes
        // Add other specific rules as required
    ],
];

return (new PhpCsFixer\Config())
    ->setRules($configRules)
    ->setFinder($finder);
