<?php

include_once __DIR__."../lib/Router.php";

class RouterTest extends \PHPUnit_Framework_TestCase{
	
	private $_routes;
	private $_router;

	public function setUp(){
		$this->_routes = array('home' => array('pattern' => '/lol/mdr', 'template' => '/mdr/pwet'),
						'bis' => array('pattern' => '/xd/ptdr', 'template' => '/ptdr/asap'),
						'ter' => array('pattern' => '/afk/vip', 'template' => '/vip/ppda')); 
		$this->_router = new Router($this->_routes);
	}

	public function tearDown(){ 
		unset($this->_routes);
		unset($this->_router);
	}

	public function testHandle(){

		$requesUri="/vip/ppda";
		$this->AssertType('array', $this->_router->handle($requesUri));

	}

	public function testMatcher(){

		$requesUri="/vip/ppda";
		$this->AssertType('string', $this->_router->matcher($requesUri));

	}

	public function testParams(){

		$route = array('home' => array('pattern' => '/lol/mdr', 'template' => '/mdr/pwet'));
		$requesUri="/vip/ppda";
		$this->AssertType('array', $this->_router->params($route, $requesUri, 'try'));

	}

}
