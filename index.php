<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/core/helpers.php';

use core\Router;

\core\Config::load();
\core\Session::start();

if (config('debug')) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

$rt = new Router();
$rt->start();