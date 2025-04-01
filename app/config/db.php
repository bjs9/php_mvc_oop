<?php

$is_test = true;

if ($is_test) {
	return [
		'host' => 'localhost',
		'name' => 'test',
		'user' => 'root',
		'pass' => ''
	];
}
return [
	'host' => 'localhost',
	'name' => 'test',
	'user' => 'test',
	'pass' => 'test'
];