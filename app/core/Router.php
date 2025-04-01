<?php

namespace app\core;

class Router {

	protected $routes = [];
	protected $params = [];

	// inc the route of site and write in vars
	public function __construct() {
		// file with routes
		$arr = require 'app/config/routes.php';
		foreach ($arr as $key => $val) {
			$this->add($key, $val);
		}
	}

	public function add($route, $params) {
		// for regulars
		$route = "#^" . $route . "$#";
		$this->routes[$route] = $params;
	}

	public function match() {
		// code for $_GET
		$url = trim($_SERVER['REQUEST_URI'], '/');
		$url = explode('?', $url);
		$url = $url[0];
		// debug($url); // - our URL

		// TODO: to config
		$default_lang = 'en';

		if ($url) {
			$lang = substr($url, 0, 2);
			$url = substr($url, 2);

			// TODO: change this construction to array of avaibles languages
			if ($lang != 'en' && $lang != 'ua') {
				$url = $lang . $url;
				$lang = $default_lang;
			}

			// Проверяем, является ли первый символ "/"
			if (isset($url[0]) && $url[0] === '/') {
				// Удаляем первый символ "/"
				$url = substr($url, 1);
			}
		} else {
			$lang = $default_lang;
		}

		$_SESSION['lang'] = $lang;

		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url)) {
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	public function start() {
		// matching the route
		if ($this->match()) {
			$path = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
			// check exist of class
			if (class_exists($path)) {
				$action = $this->params['action'] . 'Action';
				// check exist of method
				if (method_exists($path, $action)) {
					// create the controller
					$controller = new $path($this->params);
					$controller->$action();
				} else {
					View::error(404, 'method not exist', $action);
				}
			} else {
				View::error(404, 'class not exists', $path);
			}
		} else {
			View::error(404);
		}
	}

}