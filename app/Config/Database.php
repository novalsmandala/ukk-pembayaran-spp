<?php 

namespace Noval\UKK\Paket1\Config;

class Database {

	private static ?\PDO $pdo = null;

	public static function getConnection(): \PDO
	{
		if (self::$pdo == null) {

			require_once __DIR__ . "/../../config/database.php";
			$config = getDatabaseConfig(); // mengambil function dari file diataas
			self::$pdo = new \PDO (
				$config['database']['url'],
				$config['database']['username'],
				$config['database']['password']
			);
		}

		return self::$pdo;
	}

	public static function beginTransaction()
	{
		self::$pdo->beginTransaction();
	}

	public static function commit()
	{
		self::$pdo->commit();
	}

	public static function rollback()
	{
		self::$pdo->rollback();
	}
}

 ?>