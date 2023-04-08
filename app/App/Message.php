<?php 

namespace Noval\UKK\Paket1\App;

class Message {

	public static function showAlert(string $value)
	{
		echo "<script>alert('$value')</script>";
	}
}

 ?>