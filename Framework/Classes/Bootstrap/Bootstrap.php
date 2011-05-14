<?php

class Framework_Classes_Bootstrap_Bootstrap {
	
	private $_config;
	private $_dispatcher;

	static private $_instance;
	private function __construct () {}
	private function __clone() {}
	
	public static function getInstance() {
		if (NULL === self::$_instance) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	/**
		Expects CMS config as (String) filepath or (Array) config
		@param {String|Array} $config
	 */
	public function injectConfig($config) {
		if (is_array($config)) {
			$this->_config = $config;
		}

		$this->_config = Framework_Classes_Bootstrap_Bootstrap::parseConfigFile($config);  

		return self::$_instance;
	}
	
	/**
		Starts the MVC process
	 */
	public function startMvc() {       
		$this->_initAutoloader();		              
		
		$GLOBALS["L"]->load("dispatcher");
		$this->_dispatcher = Dispatcher::getInstance()->init();  	 

	}           
	
	private function _initAutoloader() {
		include_once(CMS_ROOT."/Framework/Classes/Utility/Autoloader.php");
		$GLOBALS["L"] = Framework_Classes_Utility_Autoloader::getInstance();  
		
		foreach ($this->_config["classes"] as $key => $value) {
			$this->_config["classes"][$key] = str_replace("CMS_ROOT", CMS_ROOT, $value);
		}
		
		if (isset($this->_config)) {
			$GLOBALS["L"]->injectClasses($this->_config["classes"]);
		}          
		
		return self::$_instance;
	}
	
	/**
		Utility function for parsing .ini config files
		@param	String	$filepath
		@return Array
	 */
	private static function parseConfigFile($filepath) {
		if (preg_match("/.*(.ini)$/i", $filepath)) {
			return parse_ini_file($filepath, true);                
		}        
		require_once($filepath);
		return $config;
	}

}