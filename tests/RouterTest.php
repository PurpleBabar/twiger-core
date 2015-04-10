<?php

include_once __DIR__."/../lib/Router.php";

use twiger\Router as Router;

class RouterTest extends \PHPUnit_Framework_TestCase{
	
	private $_routes;
	private $_router;

	public function setUp(){

		$this->_routes = array('home' => array('pattern' => '/lol/mdr', 'template' => 'try'),
						'bis' => array('pattern' => '/xd/ptdr', 'template' => 'trybis'),
						'ter' => array('pattern' => '/afk/vip', 'template' => 'tryter'));

		$this->_router = new Router($this->_routes);
	}

	public function tearDown(){ 
		unset($this->_routes);
		unset($this->_router);
	}

	public function testHandle(){

		$requesUri="/lol/vip";
		$toAssert = $this->_router->handle($requesUri);
		$this->assertTrue(is_null($toAssert) || is_array($toAssert));

	}

	public function testMatcher(){

		$requesUri="/vip/ppda";
		$this->assertInternalType('string', $this->_router->matcher($requesUri));

	}

	public function testParams(){

		$route = array('pattern' => '/lol/mdr', 'template' => '/mdr/pwet');
		$requesUri="/vip/ppda";
		$this->assertInternalType('array', $this->_router->params($route, $requesUri, 'try'));

	}

}
