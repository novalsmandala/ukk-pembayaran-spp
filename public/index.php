<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nourman\UKK\Pembayaran\SPP\App\Router;
use Nourman\UKK\Pembayaran\SPP\Controller\HomeController;
use Nourman\UKK\Pembayaran\SPP\Controller\KelasController;

Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/kelas', KelasController::class, 'index');

Router::run();

 ?>