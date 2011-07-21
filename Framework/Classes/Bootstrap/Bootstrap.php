<?php

class Bootstrap {
	
	private $_config;
	private $_dispatcher;

	static private $_instance;
	private function __construct () {}
	private function __clone() {}
	
	public static function getInstance() {
        $env = getenv('myEnv');
		
    	if ($env === 'Web') {
	    	return self::_getWebInstance();
		} else if ($env == 'CLI') {
			return self::_getCliInstance();
		} else {
			throw new Exception("Cannot instantiate myCms for the given environment: ".$env);
		}
	}

	/**
	 *   Expects CMS config as (String) filepath or (Array) config
	 *   @param {String|Array} $config
	 */
	public function injectConfig($config) {
		if (is_array($config)) {
			$this->_config = $config;
		}

		$this->_config = Bootstrap::parseConfigFile($config);     
		
		return self::$_instance;
	}
	
	/**
	 *   Starts the MVC process
	 */
	public function startMvc() {       
		$this->_initAutoloader();  
		$this->_initGlobalConfig();  	              
		
		$GLOBALS["L"]->load("dispatcher");
		$this->_dispatcher = Dispatcher::getInstance()
			//->preDispatch()
			->init();
			//->postDispatch();  	 
	}           
	
	private function _initAutoloader() {
		include_once(CMS_ROOT."/Framework/Classes/Utility/Autoloader.php");
		$GLOBALS["L"] = Autoloader::getInstance(); 
		if (isset($this->_config)) {
			$GLOBALS["L"]->injectClasses($this->_config["classes"]);
		}
		
		return self::$_instance;
	}               
	
	private function _initGlobalConfig() {   
		include_once(CMS_ROOT."/Framework/Classes/Utility/Config.php");
		$GLOBALS["C"] = Config::getInstance();     
		$GLOBALS["C"]->injectConfig($this->_config);
			   		
		return self::$_instance;
   	}                     

	private static function _getCliInstance() {
		if (NULL === self::$_instance) {
			self::$_instance = new self;
		}
	

		return self::$_instance;
	}
	
	private static function _getWebInstance() {
		// currently web & cli are handled the same way!
		return self::_getCliInstance();
	}
	
	/**
	 *  Utility function for parsing .ini config files
	 *  @param	String	$filepath
	 *   @return Array
	 **/
	public static function parseConfigFile($config) {
		if (preg_match("/.*(.ini)$/i", $config)) {
			return parse_ini_file($config, true);                
		}        
		return require_once($config);
	}

}
