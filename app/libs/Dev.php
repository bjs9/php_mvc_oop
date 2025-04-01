<?php


// CONFIG FUNCTIONS

function getConf($key) {
	$temp = require 'app/config/config.php';
	return $temp[$key];
}

// CONFIG FUNCTIONS END



if (getConf('DEBUG')) {
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
} else {
    ini_set("display_errors", 0);
}
