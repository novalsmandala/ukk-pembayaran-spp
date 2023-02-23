<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Nourman\UKK\Pembayaran\SPP\App\Router;
use Nourman\UKK\Pembayaran\SPP\Controller\HomeController;

Router::add('GET', '/', HomeController::class, 'index');

Router::run();

 ?>