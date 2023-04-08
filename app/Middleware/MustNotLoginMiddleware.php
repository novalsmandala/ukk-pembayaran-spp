<?php 

namespace Noval\UKK\Paket1\Middleware;

use Noval\UKK\Paket1\App\View;

class MustNotLoginMiddleware {

	 public function before()
	 {
	 	if(!isset($_SESSION)) {
	 		session_start();	
	 	}
	 	if (isset($_SESSION['login'])) {
	 		View::redirect("/home");
	 	}
	 }

	
}	

 ?>