<?php

namespace twiger;

class Router{

	private $routes;

	public function __construct($routes){
		$this->routes = $routes;
	}

	public function handle($requestUri){
		foreach ($this->routes as $name => $route)
			if (preg_match($this->matcher($route['pattern']), $requestUri))
				return $this->params($route, $requestUri, $name);	
	}

	public function matcher($requestUri){
		$matcher = addcslashes($requestUri, '/');
		$matcher = preg_replace('/({\w+})/', '\w+', $matcher);
		$matcher = '/('.$matcher.')$/A';
		return $matcher;
	}

	public function params($route, $requestUri, $name){
		$base = explode('/', $route['pattern']);
		$parametered = explode('/', $requestUri);
		for ($i=0; $i < count($base) ; $i++) { 
			if (preg_match('/({\w+})/', $base[$i])) {
				$route['route_params'][substr($base[$i], 1, -1)] = $parametered[$i];
			}
		}
		$route['name'] = $name;
		$route['requestUri'] = $requestUri;
		return $route;
	}

}
