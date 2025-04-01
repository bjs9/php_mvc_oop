<?php


// return [
//     'DEBUG'         => true,
//     'API_PASS'      => 'test',
//     'EYE_DIFFERENT' => 2
// ];

$debug = in_array($_SERVER['HTTP_HOST'], [
    'localhost',
    '127.0.0.1',
    'a-example.com'
]);

return [
    'default_lang' => 'en',
    'debug'        => $debug,

    'db' => $debug ? [
        'host' => 'localhost',
        'name' => 'example',
        'user' => 'root',
        'pass' => '',
    ] : [
        'host' => 'prod',
        'name' => 'prod',
        'user' => 'prod',
        'pass' => 'prod',
    ],

    'available_langs' => [],
];