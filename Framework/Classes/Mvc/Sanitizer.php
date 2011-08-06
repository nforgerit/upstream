<?php             
namespace my\Mvc;
  
class Sanitizer {    	
	private $_gpVars = array();  
	private $_safemode = true;    
	
	public function __construct($reqArgs, Array $sieve) {    
		$valueArr = array_merge($_GET, $_POST, $reqArgs);        

		foreach ($valueArr as $k => $v) {       			
			if (isset($sieve[$k])) {
				$this->_gpVars[$k]['value'] = filter_var($valueArr[$k], filter_id($sieve[$k]));  
				$this->_gpVars[$k]['sieved'] = true; 
			} 
			$this->_gpVars[$k]['value'] = $v;			
			unset($sieve[$k]);
		}               
 
		if (0 !== count(array_keys($sieve))) {
			throw new \Exception("Expected params were not given.");
		}
	}
	
	public function get($varname) {
		if ($this->_safemode && ! $this->_gpVars[$varname]['sieved']) {
			throw new \Exception("Accessing insecure GET/POST Parameter is not possible when being in Safemode!");
		}     
		return $this->_gpVars[$varname]['value'];
	}      
	
}

?>