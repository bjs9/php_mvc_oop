<?php

namespace app\libs;

use PDO;

class DB {

	protected $db;

	public function __construct() {
		$config = require 'app/config/db.php';

		if (getConf('DEBUG')) {
			$this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'], $config['user'], $config['pass'], [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Активируем ошибки
			]);
		} else {
			$this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'], $config['user'], $config['pass']);
		}
		
		$this->db->exec("set names utf8");
	}

	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				$stmt->bindValue(':' . $key, $val);
			}
		}
		$stmt->execute();
		return $stmt; 
	}

	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

}