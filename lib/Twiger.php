<?php

namespace twiger;

class Twiger{
	
	private $loader;
	private $twig;
	private $params;

	public function __construct($params = array() ,$path = array()){
		$path = array_merge($path, array(__DIR__.'/../error', __DIR__.'/../../../../src/templates'));
		$this->params = $params;
		$this->loader = new \Twig_Loader_Filesystem($path);
		$this->twig = new \Twig_Environment($this->loader, array(
		    'cache' => false,
		    'debug' => true
		));
		$this->twig->addExtension(new \Twig_Extension_Debug());
	}

	public function render($template, $params = array()){
		try {
			echo $this->twig->render($template, array_merge($params, $this->params) );
		} catch (\Twig_Error $e) {
			echo $this->twig->render('error.html.twig', array('error' => $e, 'errorType' => get_class($e)));
		}
	}

	public function addFunctions($functions){
		foreach ($functions as $function) {
			$this->twig->addFunction($function);
		}
	}

}