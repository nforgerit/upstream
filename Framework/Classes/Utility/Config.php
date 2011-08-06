<?php          
namespace my\Utility;
	
class Config {
	                      
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

		return self::$_instance;
	}                     
	
	public function getConfigSection($section) {
		return $this->_config[$section];
	}
}