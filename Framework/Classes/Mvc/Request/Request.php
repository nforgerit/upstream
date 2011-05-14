<?php

class Request {

	private $_requestUri;
	private $_requestParams;
	
	public function __construct() {
		// current pattern is: /module/controller/action
		$this->_requestUri = $_SERVER['REQUEST_URI'];
		$this->_process();
	}

	public function uri() {
		return $this->_requestUri;
	}

	public function controller() {
		return ucfirst($this->_requestParams["controller"])."Controller";
	}

	public function action() {
		return lcfirst($this->_requestParams["action"])."Action";
	}

	public function module() {
		return ucfirst($this->_requestParams["module"]);
	}

	public function args() {
		return $this->_requestParams["args"];
	}             
	
	public function make404() {      
		$this->_requestParams = array(
			"module"	=>	"default",
			"controller"=>	"error",
			"action"	=>	"NotFound_404",
			"params"	=>	array()
		);
	}                                

	private function _process() {	    
		$GLOBALS["L"]->load("router");
		$router = new Router;
		
		$this->_requestParams = $router->matchQuery($this->uri());   
		
		// DEFAULT ROUTE HANDLING: 
		// if (empty($this->_requestParams)) {
		// 			$this->_requestParams = $router->getDefaultRoute();
		// 		} 
		
		$this->_isRouteValid() ?: $this->make404();
	}                                
	
	private function _isRouteValid() {
		if (! file_exists(CMS_ROOT."modules/{$this->module()}/controllers/{$this->controller()}.php")) return false;
		include_once(CMS_ROOT."modules/{$this->module()}/controllers/{$this->controller()}.php");   
		
		$controllerClass = "{$this->controller()}";
		$obj = new $controllerClass; 	
		if (method_exists($obj, $this->action()))
			return true; 
	}


}