<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PHP70Migration' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'blank_line_after_opening_tag' => true,
        'concat_space' => false,
        'linebreak_after_opening_tag' => true,
        'no_extra_consecutive_blank_lines' => false,
        'no_multiline_whitespace_before_semicolons' => true,
        'no_mixed_echo_print' => ['use' => 'print'],
        'ordered_imports' => true,
        'phpdoc_align' => false,
        'phpdoc_summary' => false,
        'phpdoc_summary' => false,
        'simplified_null_return' => false,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in('src/')
            ->notPath('Migrations')
    );
