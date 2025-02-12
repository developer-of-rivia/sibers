<?php

class Router
{
	private array $routes = [];

	public function bind($uri, $controller, $method)
	{
		$args = [$uri, $controller, $method];
		array_push($this->routes, $args);
	}

	public function start()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$uri_parts = explode('?', $uri, 2);

		foreach($this->routes as $route){
			if($uri_parts[0] == $route[0])
			{
				$controller = new $route[1];
				$controller->{$route[2]}();
			}
		}
	}
}