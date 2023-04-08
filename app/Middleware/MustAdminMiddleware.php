<?php 

namespace Noval\UKK\Paket1\Middleware;

use Noval\UKK\Paket1\App\View;

class MustAdminMiddleware {

	 public function before()
	 {
	 	if(!isset($_SESSION)) {
	 		session_start();	
	 	}
	 	if ($_SESSION['role'] != 'admin') {
	 		View::redirect("/home");
	 	}
	 }

	
}	

 ?>