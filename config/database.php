<?php 

function getDatabaseConfig(): array
{
	return [
		"database" => [
				"test" => [
						"url" => "mysql:host=localhost:3306;dbname=db_spp_test",
						"username" => "root",
						"password" => ""
					],
			"prod" => [
						"url" => "mysql:host=localhost:3306;dbname=db_spp",
						"username" => "root",
						"password" => ""
					]
			]
		];
}

 ?>