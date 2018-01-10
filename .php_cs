<?php

$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap/cache')
    ->notPath('storage')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2'                  => true,
        'binary_operator_spaces' => [
                'operators' => [
                    '=>' => 'align_single_space',
                    '='  => 'single_space',
                ],
            ],
        'array_syntax'                          => ['syntax' => 'short'],
        'align_multiline_comment'               => ['comment_type' => 'phpdocs_only'],
        'linebreak_after_opening_tag'           => true,
        'not_operator_with_successor_space'     => true,
        'ordered_imports'                       => true,
        'phpdoc_order'                          => true,
        'object_operator_without_whitespace'    => true,
        'no_whitespace_before_comma_in_array'   => true,
        'trailing_comma_in_multiline_array'     => true,
        'trim_array_spaces'                     => true,
        'whitespace_after_comma_in_array'       => true,
        'new_with_braces'                       => true,
        'blank_line_before_return'              => true,
        'unary_operator_spaces'                 => true,
        'phpdoc_indent'                         => true,

    ])
    ->setFinder($finder);
