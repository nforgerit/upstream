<?php         
namespace my\Mvc\View\Renderer;

class XSLT extends AbstractRenderer {    
	
	private $_datafile;
	private $_stylesheet;
	
	public function injectDatafile($filename) {  
		if (file_exists($filename)) {
			$this->_datafile = new \DOMDocument;
			$this->_datafile->loadXML(file_get_contents($filename));	
		} else {
			throw new \Exception("Given datafile {$filename} doesn't exist!");
		}
	}   
	
	public function injectStylesheet($filename) {
		if (file_exists($filename)) {
			$this->_stylesheet = new \DOMDocument;
			$this->_stylesheet->loadXML(file_get_contents($filename));	 
		} else {
			throw new \Exception("Given stylesheet {$filename} doesn't exist!");
		}
	}         
	
	public function exec() {
		$proc = new \XSLTProcessor; 
		$proc->importStylesheet($this->_stylesheet);
		$content = $proc->transformToXML($this->_datafile);
		
		return $content;
	}                             
	
}


?>