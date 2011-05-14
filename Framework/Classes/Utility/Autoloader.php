<?php

class Autoloader {
	
	private $_classes;  
	
	static private $_instance;
	private function __construct () {}
	private function __clone() {}
	
	public static function getInstance() {
		if (NULL === self::$_instance) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}
	
	public function injectClasses($classes) {
		$this->_classes = $classes;
	}                              
	
	public function load($classname) {                              
		$classname = ucfirst($classname);
		$classpath = $this->_classes[$classname]["file"];    
		
		require_once($classpath);           
	}
}


