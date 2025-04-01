<?php

use core\Lang;

function __(string $key): string {
    return Lang::get($key);
}

function debug($var) {
	echo("<pre>");
	var_dump($var);
	echo("</pre>");
}