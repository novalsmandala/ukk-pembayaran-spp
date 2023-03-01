<?php 

namespace Nourman\UKK\Pembayaran\SPP\Config;

class Database {


	private static ?\PDO $pdo = null;

	public static function getConnection(string $env = "test"): \PDO 
	{
		// create new PDO
		require_once __DIR__ . '/../../config/database.php';
	}
}

 ?>