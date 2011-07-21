<?php

class Renderer {

	private $_renderer;

	private $_values;

	public function injectRenderer($renderer) {
		$this->_renderer = $renderer;
	}

	public function assign(Array $vars) {
		// pattern: array ( "PLACEHOLDER" => "VALUE")
		$this->_values = array_merge($this->_values, $vars);
		
	}
	
	public function render() {
		
	}
}