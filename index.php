<?php

require __DIR__ . '/app/libs/Dev.php';
require __DIR__ . '/vendor/autoload.php';

use core\Router;

session_start();

$rt = new Router();
$rt->start();