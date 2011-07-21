<?php

// module,controller,action name: /[a-zA-Z0-9.-]/i
// preparing a param: /:module/:controller/:action/:param1§INT/:param2§REGEXP[/^pre/i]/:param3§EMAIL/:param4§BOOLEAN

class Route {
                              
	private $_priority; // 0 = lowest, 99 = highest
	private $_pattern;
	private $_requestParams;
	
	public function __construct($routeConfig) {  	
		if (! isset($routeConfig)) {     
			throw new Exception("Configuration Error: Route pattern not set.");
		}      
                              
		$this->_priority = $routeConfig["priority"];
		$this->_pattern = $routeConfig["pattern"];
		$this->_requestParams = $routeConfig["requestParams"];
	}                 
	
	public static function cmpRoutes(Route $r1, Route $r2) {
		if ($r1 === $r2 || $r1->getPrio() == $r2->getPrio()) return 0;		
		return ($r1->getPrio() > $r2->getPrio()) ? +1 : -1;
	}                       
	
	public function getPrio() {
		return $this->_priority;
	}

	public function matches($query) {
		// do some superficial (== fast) check
		// whether the given query matches this routeObject    
		
		// 1) match uri divisions 
		if (substr_count($query, '/') !== substr_count($this->_pattern, '/')) {
			return false;
		}
		
		// 2) match each division from left to right
       		return $this->_matchSubparts($query);

	}

	public function requestParams() {
		// do some regexp magic in here to fetch
		// all the informations from the given query
		// and put it into the _requestPatterns array
		return $this->_requestParams;
	}           
	
	private function _matchSubparts($query) {
		// pre-defined types
		$REGEX_TYPES = array(
			":module"	=>	"/^[a-zA-Z][a-zA-Z0-9]+$/",
			":controller"	=>	"/^[a-zA-Z][a-zA-Z0-9]+$/",  
			":action"	=>	"/^[a-zA-Z][a-zA-Z0-9]+$/",
			":integer"	=>	"/^[1-9][0-9]+$/",
			":boolean"	=>	"/^(true|false)$/",
		);

		$queryDivisions = explode('/', trim($query, '/'));
		$patternDivisions = explode('/', trim($this->_pattern, '/'));   

		while (count($queryDivisions) > 0 && count($patternDivisions) > 0) {
			$qDiv = array_shift($queryDivisions);
			$pDiv = array_shift($patternDivisions);

			// skip if pDiv is a constant
			if (substr($pDiv, 0, 1) !== ":") continue;

			// use pre-defined patterns from above
			if (in_array($pDiv, array_keys($REGEX_TYPES))) {
				$_pattern = $REGEX_TYPES[$pDiv];
			}
			// use the module's defined regexp patterns
			else if (in_array($pDiv, array_keys($this->_requestParams['params']))) {
				$_pattern = $this->_requestParams['params'][$pDiv];
			}

			// match the pattern and collect given params
			if (! preg_match($_pattern, $qDiv)) { return false;	}
			else {
				$this->_requestParams[substr($pDiv,1)] = $qDiv;
			} 
		}
		
		return true;
	}
}
