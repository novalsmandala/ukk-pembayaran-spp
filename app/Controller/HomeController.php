<?php 

namespace Nourman\UKK\Pembayaran\SPP\Controller;
use Nourman\UKK\Pembayaran\SPP\App\View;

class HomeController {

	function index(): void 
	{
		View::render("home/index", null);
	}
}

 ?>