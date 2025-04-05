<?php

use core\Lang;
use core\Config;
use core\Session;

// Get text
function __(string $key): string {
    return Lang::get($key);
}

// Get config
function config(string $key, $default = null) {
    return Config::get($key, $default);
}

// Echo variable
function debug($var) {
	echo("<pre>");
	var_dump($var);
	echo("</pre>");
}

// Check session var
function session_has(string $key): bool {
    return Session::has($key);
}

// Set session var
function session_set(string $key, mixed $value): void {
    Session::set($key, $value);
}

// Get session var
function session_get(string $key, mixed $default = null): mixed {
    return Session::get($key, $default);
}

// Set session flash
function session_flash(string $key, string $message): void {
    Session::flash($key, $message);
}

// Get session flash
function session_get_flash(string $key): ?string {
    return Session::getFlash($key);
}