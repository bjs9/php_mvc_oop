<?php

use core\Lang;
use core\Config;

function __(string $key): string {
    return Lang::get($key);
}

function config(string $key, $default = null) {
    return Config::get($key, $default);
}

function debug($var) {
	echo("<pre>");
	var_dump($var);
	echo("</pre>");
}