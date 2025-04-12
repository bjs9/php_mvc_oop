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
    'default_lang'    => 'en',
    'available_langs' => [],
    'debug'           => $debug,
    'migration_key'   => 'a_b_cSecret2025', /* /migration-start?key=a_b_cSecret2025 */

    'db' => $debug ? [
        'host' => 'localhost',
        'name' => 'phpmvcoop',
        'user' => 'root',
        'pass' => '',
    ] : [
        'host' => 'prod',
        'name' => 'prod',
        'user' => 'prod',
        'pass' => 'prod',
    ],

];