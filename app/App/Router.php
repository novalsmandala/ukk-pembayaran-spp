<?php 

namespace Noval\UKK\Paket1\App;

class Router {

	private static array $routes = [];

	public static function add(string $method,
														string $path,
														string $controller,
														string $function,
														array $middlewares = [])
	{
		self::$routes[] = [
			"method" => $method,
			"path" => $path,
			"controller" => $controller,
			"function" => $function,
			"middleware" => $middlewares,
		];
	}

	public static function run()
	{
		$path = "/";
		if (isset($_SERVER['PATH_INFO'])) {
			$path = $_SERVER['PATH_INFO'];
		}

		$method = $_SERVER["REQUEST_METHOD"];

		foreach (self::$routes as $route) {
			$pattern = "#^" . $route['path'] . "$#";
			if (preg_match($pattern, $path , $variables) && $route['method'] == $method) {
				foreach ($route['middleware'] as $middleware) {
					$instance = new $middleware;
					$instance->before();
				}
				
				$controller = new $route['controller'];
				array_shift($variables);
				call_user_func_array([$controller, $route['function']], $variables);
				return;
			}
		}

		http_response_code(404);
		echo "not found";
	}
}

 ?>