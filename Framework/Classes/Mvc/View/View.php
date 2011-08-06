<?php          
namespace my\Mvc\View;

class View {     
	
	private $_template;              
	private $_renderer;
	
	public function injectRenderer(\my\Mvc\View\Renderer\AbstractRenderer $renderer) {
		$this->_renderer = $renderer;
	} 
	
	public function render() {     
		if (isset($this->_renderer)) {
			$content = $this->_renderer->exec();
			return $content;
		}
	}                      
	
	public function add(\my\Mvc\View\Renderer\RenderingObjectInterface $domainObject) {
		$this->injectRenderer($domainObject->provideRenderer());
	}

}                

?>
