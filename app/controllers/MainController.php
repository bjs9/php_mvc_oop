<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

	public function indexAction() {
		$this->view->render($this->route['title']);
	}

	public function testAction() {
		$this->view->render($this->route['title']);
	}

}
