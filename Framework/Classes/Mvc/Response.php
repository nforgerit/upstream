<?php 
namespace my\Mvc;

class Response {
	
	private $_content;
	
	public function injectBody(\my\Mvc\View\View $body) {
		$this->_content = $body->render();
	}
	
	public function send() {
		echo $this->_content;
	}
	
}
