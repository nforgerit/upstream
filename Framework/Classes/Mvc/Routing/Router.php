<?php

class Router {
	private $_routes;        
	private $_defaultRoute;
	
	public function __construct () {
		$this->_collectRouteConfigs();
	}

	private function _collectRouteConfigs() {  
		$GLOBALS["L"]->load("route");
		
		$this->_defaultRoute = $GLOBALS["C"]->getConfigSection("defaultRoute");
		$REGISTERED_MODULES = $GLOBALS["C"]->getConfigSection("modules");     
        
		foreach ($REGISTERED_MODULES as $module) {     
			$moduleName = lcfirst($module['name']);
			include_once(CMS_ROOT."/Modules/{$moduleName}/config.php");
			
			if ($module["allowOverwriteRoutes"] === "true") {
				if (isset($module['defaultRoute']['controller']))
					$this->_defaultRoute['controller'] = $module['defaultRoute']['controller'];
				if (isset($module['defaultRoute']['action'])) 
					$this->_defaultRoute['action'] = $module['defaultRoute']['action'];
				if (isset($module['defaultRoute']['module']))
					$this->_defaultRoute['module'] = $module['defaultRoute']['module'];
			
				unset($module['defaultRoute']);
			}                      
			
			foreach ($config['routes'] as $routeConfig) {  				
				$this->_routes[] = new Route($routeConfig);
			}			                  
		}               
              
		// fetch standard route
		$this->_defaultRoute = array(
			"module"		=>	isset($this->_defaultRoute['module']) ? $this->_defaultRoute['module'] : "default",	
			"controller"	=>	isset($this->_defaultRoute['controller']) ? $this->_defaultRoute['controller'] : "index",	
			"action"		=>	isset($this->_defaultRoute['action']) ? $this->_defaultRoute['action'] : 'index',	
		);   

	}           
	
	public function getDefaultRoute() {
		return $this->_defaultRoute;
	}
	
	public function matchQuery($query) {  
	    // sort collected routes by priority
		usort($this->_routes, array("Route", "cmpRoutes"));
	 
		foreach ($this->_routes as $route) {
			if ($route->matches($query)) {   
				return $route->requestParams();
			}
		}
	}
}