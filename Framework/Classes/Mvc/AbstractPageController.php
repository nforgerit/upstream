<?php    
namespace my\Mvc;

class AbstractPageController implements \my\Mvc\PageControllerInterface {
	
	protected $_dispatcher;
	protected $_view;
	
	public function injectDispatcher(\my\Mvc\Dispatcher $dispatcher) {
		$this->_dispatcher = $dispatcher;     
		$this->_view = $this->_dispatcher->getView();        
	}          
	
	public function preDispatch() {}
	public function postDispatch() {}
	
}               

?>