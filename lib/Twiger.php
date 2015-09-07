<?php

namespace twiger;

class Twiger{
	
	protected $loader;
	protected $twig;
	protected $params;

	public function __construct($config = array(), $params = array(), $path = array()){
		$path = array_merge($path, array(__DIR__.'/../../../../src/templates', __DIR__.'/../error'));
		$this->params = $params;
		$this->loader = new \Twig_Loader_Filesystem($path);
		$this->twig = new \Twig_Environment($this->loader, array(
		    'cache' => false,
		    'debug' => true
		));
		$this->twig->addExtension(new \Twig_Extension_Debug());

		if (isset($config['database'])) {
			\ORM::configure('mysql:host='.$config['database']['host'].';dbname='.$config['database']['name']);
			\ORM::configure('username', $config['database']['user']);
			\ORM::configure('password', $config['database']['password']);
		}
	}

	public function render($template, $params = array()){
		try {
			return $this->twig->render($template, array_merge($params, $this->params) );
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
