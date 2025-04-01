<?php

namespace core;

class Lang {

    protected static $phrases = [];

    // load lang file
    public static function load(string $langCode): void {
        $file = __DIR__ . "/../lang/{$langCode}.php";

        if (file_exists($file)) {
            self::$phrases = require $file;
        } else {
            // fallback
            self::$phrases = require __DIR__ . "/../lang/en.php";
        }
    }

    // get string
    public static function get(string $key): string {
        return self::$phrases[$key] ?? $key;
    }

}