<?php


return [

    "target_php_version" => '7.3',
    'directory_list' => [
        'Omega',
        'vendor/symfony/dom-crawler',
        'vendor/guzzlehttp/guzzle',
        'vendor/psr/http-message'
    ],
    "exclude_analysis_directory_list" => [
        'vendor/'
    ],
    'plugins' => [
        'AlwaysReturnPlugin',
        'DollarDollarPlugin',
        'DuplicateArrayKeyPlugin',
        'PregRegexCheckerPlugin',
        'PrintfCheckerPlugin',
        'UnreachableCodePlugin',
        #'DuplicateExpressionPlugin',
        #'SleepCheckerPlugin',
        // Checks for syntactically unreachable statements in
        // the global scope or function bodies.
        #'UseReturnValuePlugin',
        #'EmptyStatementListPlugin',
        #'LoopVariableReusePlugin',
    ],
];
