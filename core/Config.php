<?php

namespace core;

class Config {

    protected static $config = [];

    public static function load(): void {
        $file = __DIR__ . '/../app/config/config.php';

        if (file_exists($file)) {
            self::$config = require $file;
        } else {
            die("Critical error: Configuration file not found at {$file}");
        }

        // Auto detect available_langs
        $langFiles = glob(__DIR__ . '/../lang/*.php');
        $langs = [];

        foreach ($langFiles as $file) {
            $langs[] = basename($file, '.php');
        }

        self::$config['available_langs'] = $langs;
    }

    public static function get(string $key, $default = null) {
        return self::$config[$key] ?? $default;
    }

    public static function set(string $key, $value): void {
        self::$config[$key] = $value;
    }

}