<?php

namespace app\libs;

use PDO;

class DB {

	protected $db;

	public function __construct() {
		$config  = config('db');
		$options = [];
		$dsn     = "mysql:host={$config['host']};dbname={$config['name']};charset=utf8";

		if (config('debug')) {
			$options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		}

		try {
			$this->db = new PDO($dsn, $config['user'], $config['pass'], $options);
		} catch (\PDOException $e) {
			if (config('debug')) {
				die('Database error: ' . $e->getMessage());
			}
			die('Database error');
		}
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