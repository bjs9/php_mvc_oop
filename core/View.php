<?php

namespace core;

use core\Lang;

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
		if (file_exists('app/views/' . $this->path)) {
			ob_start();
			require 'app/views/' . $this->path;
			$content = ob_get_clean();
			require 'app/views/layouts/' . $this->layout . '.php';
		} else {
			$this->error(404, "Oops, The Page you are looking for can't be found!", $this->path);
		}
	}

	public function redirect($url) {
		header('location: ' . $url);
		exit;
	}

	public static function error($code, $why_type = false, $why = false) {
		if ($why_type && $why) {
			echo ' ' . $why_type . ': ' . $why;
		}

		$title = "Error: " . $code;

		if ($code == 404) {
			$msg = "Oops, The Page you are looking for can't be found!";
		} else {
			$msg = "Some error";
		}

		ob_start();
		require 'app/views/error.php';
		$content = ob_get_clean();
		require 'app/views/layouts/default.php';
	}

}