<?php 

namespace Nourman\UKK\Pembayaran\SPP\Config;

use Nourman\UKK\Pembayaran\SPP\Test;
use Nourman\UKK\Pembayaran\SPP\Assertions;
use Nourman\UKK\Pembayaran\SPP\Config\Database;

class DatabaseTest extends Test{

  public function testGetConnection()
  {
    $connection = Database::getConnection();
    Assertions::assertNotNull($connection, '');
  }

  public function testGetConnectionSingleton()
  {
    $connection1 = Database::getConnection();
    $connection2 = Database::getConnection();
    Assertions::assertSame($connection1, $connection2);
  }

}


 ?>