<?php  
namespace my\Mvc;

interface PageControllerInterface {              
	public function injectDispatcher(Dispatcher $dispatcher);      
	public function preDispatch();
	public function postDispatch();
}                                  

?>