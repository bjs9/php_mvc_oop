<?php

namespace app\core;

class View {

	public $route;
	public $path;
	public $layout = 'default';
	public $pages;

	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['controller'] . '/' . $route['action'] . '.php';
		$this->path = str_replace('__', '/', $this->path);
	}

	/**
	 * @param array|bool $vars
	 */
	public function render($title, $vars = false) {
		if ($vars) {
			extract($vars);
		}
		if (file_exists('app/views/' . $_SESSION['lang'] . '/' . $this->path)) {
			ob_start();
			require 'app/views/' . $_SESSION['lang'] . '/' . $this->path;
			$content = ob_get_clean();
			require 'app/views/'  . $_SESSION['lang'] . '/' .  'layouts/' . $this->layout . '.php';
			$_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];
		} else {
			$this->error(404, "Oops, The Page you are looking for can't be found!", $this->path);
		}
	}

	public function redirect($url) {
		header('location: ' . $url);
		exit;
	}

	public static function error($code, $why_type = false, $why = false) {
		echo $code . "<br>";
		if ($why_type && $why) {
			echo ' ' . $why_type . ': ' . $why;
		}
		$title = "Ошибка: " . $code;
		if ($code == 404) {
			$msg = "Oops, The Page you are looking for can't be found!";
		} else {
			$msg = "Some error";
		}
		ob_start();
		require 'app/views/'  . $_SESSION['lang'] . '/' .  'error.php';
		$content = ob_get_clean();
		echo('404! <a href="/">Return to -> HomePage</a>');
		require 'app/views/'  . $_SESSION['lang'] . '/' .  'layouts/default.php';
		$_SESSION['last_uri'] = $_SERVER['REQUEST_URI'];
	}

}