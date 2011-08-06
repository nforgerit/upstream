<?php       
namespace my\Utility;

class Autoloader {
	
	private $_config;  
	
	static private $_instance;
	private function __construct () {}
	private function __clone() {}
	
	public static function getInstance() {
		if (NULL === self::$_instance) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}
	
	public function injectConfig($config) {
		$this->_config = $config;  
		
		return self::getInstance();    
	}                              
	
	public static function register_autoload() {
		spl_autoload_register(
			function($classname) {      
				$a = explode('\\', $classname);          
				// 
				// 
				// if (lcfirst($a[2]) === "my" ) {
				// 	echo "<pre>";
				// 		var_export($classname);
				// 		var_dump(debug_backtrace());
				// 		die("died in ".__METHOD__." -- line ".__LINE__);
				// 	echo "</pre>";
				// 	
				// }         
				
				
				if ("my" === $a[0]) {      
					// we need to load module classes
					if (ctype_lower($a[1])) {
						if ("View" === ucfirst(substr($a[2], -4))) {
							require_once(CMS_ROOT."/Modules/".lcfirst($a[1])."/views/".ucfirst($a[2]).".php");
						} else if ("Controller" === ucfirst(substr($a[2], -10))) {
							require_once(CMS_ROOT."/Modules/".lcfirst($a[1])."/controllers/".ucfirst($a[2]).".php");
						} else {     
							require_once(CMS_ROOT."/Modules/".lcfirst($a[1])."/models/".ucfirst($a[2]).".php");
						}					
					// load framework classes	
					} else {                          
						unset($a[0]);
						$fpath = CMS_ROOT."/Framework/Classes/";
						$fpath .= implode("/", $a);
						$fpath .= ".php";      
  
						require_once($fpath);
					}
				} 
			}
		);          
		
		return self::getInstance();       
	}
}


