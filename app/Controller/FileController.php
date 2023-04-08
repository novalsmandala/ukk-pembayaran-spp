<?php 

namespace Noval\UKK\Paket1\Controller;

use Noval\UKK\Paket1\App\View;

class FileController {

	public function getFile(string $type, string $path)
	{
		
		$file = __DIR__ . "/../View/Asset/" . $path . "." . $type;
		// var_dump($file);
		if (file_exists($file)) {
			header("Content-Type: ");
			readfile($file);
			exit();
		}
		echo "file not found";
	}
}

 ?>