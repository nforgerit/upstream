<?php

// module,controller,action name: /[a-zA-Z0-9.-]/i
// preparing a param: /:module/:controller/:action/:param1§INT/:param2§REGEXP[/^pre/i]/:param3§EMAIL/:param4§BOOLEAN

class Route {

	private $_pattern;
	private $_requestParams;
	
	public function __construct($routeConfig) {  	
		if (! isset($routeConfig["routePattern"])) {     
			throw new Exception("Configuration Error: Route pattern not set.");
		}      
		
		$this->_pattern = $routeConfig["routePattern"];     
	}

	public function matches($query) {
		// do some superficial (== fast) check
		// whether the given query matches this routeObject    
		
		// 1) match uri divisions 
		if (substr_count($query, '/') !== substr_count($this->_pattern, '/')) return false;
		
		// 2) match each division from left to right
       	return $this->_matchSubparts($query, $this->_pattern);
	}

	public function requestParams() {
		// do some regexp magic in here to fetch
		// all the informations from the given query
		// and put it into the _requestPatterns array
		return $this->_requestParams;
	}           
	
	private function _matchSubparts($query, $pattern) {
		$REGEX_TYPES = array(
			":module"	=>	"/^[a-zA-Z][a-zA-Z0-9]+$/",
			":controller"=>	"/^[a-zA-Z][a-zA-Z0-9]+$/",  
			":action"	=>	"/^[a-zA-Z][a-zA-Z0-9]+$/",
			":integer"	=>	"/^[1-9][0-9]+$/",
			":boolean"	=>	"/^(true|false)$/",
		);
		
		$queryDivisions = explode('/', $query);
		$patternDivisions = explode('/', $pattern);   
		                             
		// remove first array element, since they are always empty
		array_shift($queryDivisions);
		array_shift($patternDivisions);     
				
		while (count($queryDivisions) > 0) {
			$pq = array_shift($queryDivisions);
			$pp = array_shift($patternDivisions);

			if (! preg_match($REGEX_TYPES[$pp], $pq)) { return false; }
			else {
				$this->_requestParams[substr($pp,1)] = $pq;
			} 
		}                         
		
		return true;
	}
}