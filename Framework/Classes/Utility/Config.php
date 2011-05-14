<?php
	
class Framework_Classes_Utility_Config {
	                      
	private $_config;
	
	public function __construct($filepath) {      
		if (isset($filepath)) {
			$this->_config = simplexml_load_file($filepath);
		}
	}
}