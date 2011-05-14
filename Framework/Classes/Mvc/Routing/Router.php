<?php

class Router {
	private $_routes;        
	private $_defaultRoute;
	
	public function __construct () {
		$this->_collectRouteConfigs();
	}

	private function _collectRouteConfigs() {  
		$GLOBALS["L"]->load("route");
		
		$GLOBAL_ROUTES = CMS_ROOT."/routes.ini";
		$MODULE_ROUTES = CMS_ROOT."/modules/default/routes.ini";

		// module routes overwrite global routes      
		// TODO: provide keyword for write-protected global routes which raises an exception if not obeyed
		$routeConfigs = array();
		$routeConfigs[] = parse_ini_file($GLOBAL_ROUTES);
		$routeConfigs[] = parse_ini_file($MODULE_ROUTES);     
        
		// process configured routes
		foreach ($routeConfigs as $routeConfig) {
			$this->_routes[] = new Route($routeConfig);
		}                                
		                            
		// fetch standard route
		$this->_defaultRoute = array(
			"module"		=>	isset($routeConfigs[1]["defaultModule"]) ? $routeConfigs[1]["defaultModule"] : $routeConfigs[0]["defaultModule"],	
			"controller"	=>	isset($routeConfigs[1]["defaultController"]) ? $routeConfigs[1]["defaultController"] : $routeConfigs[0]["defaultController"],	
			"action"		=>	isset($routeConfigs[1]["defaultAction"]) ? $routeConfigs[1]["defaultAction"] : $routeConfigs[0]["defaultAction"],	
		);
	}           
	
	public function getDefaultRoute() {
		return $this->_defaultRoute;
	}

	public function matchQuery($query) {
		foreach ($this->_routes as $route) {
			if ($route->matches($query)) {
				return $route->requestParams();
			}
		}
	}
}