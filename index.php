<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/core/helpers.php';

use core\Router;

session_start();

$rt = new Router();
$rt->start();