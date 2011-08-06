<?php      
namespace my\Mvc;

class Request {
                                 
	private $_dispatcher;
	private $_requestUri;
	private $_requestParams;
	
	public function __construct(\my\Mvc\Dispatcher $dispatcher = NULL) { 
		if (isset($dispatcher)) {
			$this->_dispatcher = $dispatcher;
		}
		
		$this->_requestUri = $this->_normalizeRequestUri($_SERVER['REQUEST_URI']);    
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
		return isset($this->_requestParams["args"]) ? $this->_requestParams["args"] : array();
	}             
	
	public function make404() {      
		$this->_requestParams = array(
			"module"	=>	"standard",
			"controller"=>	"error",
			"action"	=>	"NotFound_404",
			"params"	=>	array()
		);                 
	}                                

	private function _process() {	    
		$router = new \my\Mvc\Routing\Router;     
		                        
		$this->_requestParams = $router->matchQuery($this->uri());   
 
		if ($this->uri() == "/" && !isset($this->_requestParams)) {   
			$this->_requestParams = $router->getDefaultRoute(); 
		}                              
		              
		$this->_isRouteValid() ?: $this->make404();
	}                                
	
	private function _isRouteValid() {    
		if (! file_exists(CMS_ROOT."/modules/{$this->module()}/controllers/{$this->controller()}.php")) return false;
		include_once(CMS_ROOT."/modules/{$this->module()}/controllers/{$this->controller()}.php");   
		
		$controllerClass = "\\my\\".$this->module()."\\".$this->controller();           
		$obj = new $controllerClass($this->_dispatcher); 	
		if (method_exists($obj, $this->action()))
			return true; 
	}         
	
	private function _normalizeRequestUri($uri) {  
		if ($uri !== "/") return "/".trim($uri, "/")."/";
		else return $uri;
	}


}
