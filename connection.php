<?php

class Db 
{
	private static $instance = NULL;

	private function __construct() {}

	private function __clone() {}

	public static function getInstance($db_connect) {
		if (!isset(self::$instance)){
			$host = getenv('DB_HOST');
			$username = getenv('DB_USERNAME');
			$password = getenv('DB_PASSWORD');
			$dbname = getenv('DB_DATABASE');
			$options = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);

			if (!$db_connect){
				$dsn = "mysql:host=" . $host;
			} else {
				$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
			}

			self::$instance = new PDO($dsn, $username, $password, $options);
		}
		return self::$instance;
	}
}
?>