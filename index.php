<?php

require 'app/libs/Dev.php';

use app\core\Router;

// Указываем запрещенные IP-адреса
$blocked_ips = [
    '91.195.98.92',
];

// Получаем IP пользователя
$user_ip = $_SERVER['REMOTE_ADDR'];

// Проверяем, есть ли IP в списке
if (in_array($user_ip, $blocked_ips)) {
    header('HTTP/1.1 403 Forbidden'); // Отправляем заголовок 403
    die('Access Denied');
}

// Автозагрузка классов
spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

$rt = new Router();
$rt->start();