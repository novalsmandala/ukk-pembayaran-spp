<?php 

namespace Nourman\UKK\Pembayaran\SPP\Controller;

use Nourman\UKK\Pembayaran\SPP\App\View;

class KelasController {

	public function index()
	{
		View::render("kelas/index" , null);
	}
}

 ?>