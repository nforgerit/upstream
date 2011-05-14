<?php

class Dispatcher {        
	
	private $_modules;

	private $_request;
	private $_response;
	private $_view;

	private static $_instance;
	
	private function __construct() {}
	private function __clone() {}

	public function getInstance() {
		if (NULL === self::$_instance) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	public function init() {
		$this->dispatch();

		return self::$_instance;
	}

	private function dispatch() {
		$requestPath = $this->getRequest()->uri();
		                                
		$module = $this->getRequest()->module();
		$controller = $this->getRequest()->controller();
		$action = $this->getRequest()->action();
        
		include_once(CMS_ROOT."modules/{$module}/controllers/{$controller}.php");   

		$actionController = new $controller;
		call_user_func(
			array(
				&$actionController,
				$action
			),           
			$this->getRequest()
		);           

	}               
		
	public function injectModules($modules) {
	
		return self::$_instance;
	}             
	
	public function injectDefaultRoutes($routes) {

		return self::$_instance;
	}

	public function getRequest() {
		if (NULL === $this->_request) {
			$GLOBALS["L"]->load("request"); 
			$this->_request = new Request;
		}

		return $this->_request;
	}

	public function getResponse() {
		if (NULL === $this->_response) {
			$GLOBALS["L"]->load("response");
			$this->_response = new Response;
		}

		return $this->_response;
	}

	public function getView() {
		if (NULL === $this->_view) {
			$GLOBALS["L"]->load("view");   
			$this->_view = new View;
		}

		return $this->_view;
	}
}
