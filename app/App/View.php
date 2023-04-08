<?php 

namespace Noval\UKK\Paket1\App;

class View {

	public static function render(string $path, array $models = [], bool $withTemplate = true)
	{
		$pathServer = $_SERVER["PATH_INFO"] ?? '';
		$value = explode("/", $pathServer);
		$curentPath = $value[1];
		if ($withTemplate) $username = $_SESSION['username'];

		if ($withTemplate) require_once __DIR__ . "/../View/Template/header.php";
		require_once __DIR__ . "/../View/" . $path . ".php";
		if ($withTemplate) require_once __DIR__ . "/../View/Template/footer.php";
	}

	public static function redirect(string $url, string $message = null)
	{
		if (!is_null($message))echo "<script>alert('{$message}')</script>";
		echo "<script>window.location = '{$url}'</script>";
		exit();
	}
}

 ?>