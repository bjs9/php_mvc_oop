<?php

namespace app\controllers;

use app\libs\MigrationRunner;
use core\Controller;

class MigrationController extends Controller {

	public function indexAction() {
		
        $keyFromRequest = $_GET['key'] ?? '';
        $expectedKey    = config('migration_key');

        if ($keyFromRequest !== $expectedKey) {
            http_response_code(404);
            return;
        }

        $runner = new MigrationRunner();
        $result = $runner->runAll();

        echo("<pre>");
        echo("Migration Results:\n\n");
        foreach ($result as $message) {
            echo($message . "\n");
        }
        echo("</pre>");

	}

}
