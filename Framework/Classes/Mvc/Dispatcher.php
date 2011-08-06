<?php      
namespace my\Mvc;

class Dispatcher {        
                                            
	private $_request;
	private $_response;
	private $_view;             

	private static $_instance;
	
	private function __construct() {}
	private function __clone() {}

	public static function getInstance() {
		if (NULL === self::$_instance) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}             
	
	public function preDispatch() {
		return self::$_instance;
	}     
		
	public function postDispatch() { 
		return self::$_instance;
	}

	public function init() {
		$this->_dispatch();

		return self::$_instance;
	}

	private function _dispatch() {                 
		$module = lcfirst($this->getRequest()->module());
		$controller = ucfirst($this->getRequest()->controller());
		$action = lcfirst($this->getRequest()->action());         
		
		$controllerClass = "\\my\\{$module}\\{$controller}";		
		$pageController = new $controllerClass;           	
		$pageController->injectDispatcher(self::getInstance());		

		$pageController->preDispatch();    		
		call_user_func(
			array(
				&$pageController,
				$action
				)
		);                               
		$pageController->postDispatch();

		$this->_finish();     
	}           
	
	private function _finish() {
		$this->getResponse()->injectBody(
			$this->getView()
		);          

		$this->getResponse()->send();
	}          

	public function getRequest() {
		if (NULL === $this->_request) {
			$this->_request = new \my\Mvc\Request;
		}

		return $this->_request;
	}

	public function getResponse() {
		if (NULL === $this->_response) {
			$this->_response = new \my\Mvc\Response;
		}

		return $this->_response;
	}

	public function getView() {
		if (NULL === $this->_view) {
			$this->_view = new \my\Mvc\View\View;
		}

		return $this->_view;
	}               

}
