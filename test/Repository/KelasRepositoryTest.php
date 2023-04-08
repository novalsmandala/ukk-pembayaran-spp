<?php 

use Noval\UKK\Paket1\Repository\KelasRepository;
use Noval\UKK\Paket1\Config\Database;

$kelasRepository = new KelasRepository(Database::getConnection());

 ?>