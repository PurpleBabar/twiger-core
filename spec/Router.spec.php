<?php 

use twiger\Router;
/**
* primary @author purplebabar(lalung.alexandre@gmail.com)
*/
describe("Router", function() {
    context("Regular", function() {
        beforeAll(function() {
            $this->_routes = array('home' => array('pattern' => '/lol/mdr', 'template' => 'try'),
    						'bis' => array('pattern' => '/xd/ptdr', 'template' => 'trybis'),
    						'ter' => array('pattern' => '/afk/vip', 'template' => 'tryter'));
            $this->_router = new Router($this->_routes);
        });

        describe("matcher()", function() {
            it("is string", function() {
                expect($this->_router->matcher("/vip/ppda"))->toBeA('string');
            });
            it("is string", function() {
                expect($this->_router->matcher("/xd/ptdr"))->toBeA('string');
            });
        });

        describe("params()", function() {
            it("is array", function() {
                $route = array('pattern' => '/lol/mdr', 'template' => '/mdr/pwet');
        		$requesUri="/vip/ppda";
                expect($this->_router->params($route, $requesUri, "try"))->toBeA('array');
            });
        });

        describe("handle()", function() {
            it("is array", function() {
                expect($this->_router->handle("/lol/mdr"))->toBeA('array');
            });
            it("is null", function() {
                expect($this->_router->handle("/lol/vip"))->toBeA('null');
            });
        });
    });
});