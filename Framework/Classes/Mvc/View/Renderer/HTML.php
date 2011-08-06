<?php         
namespace my\Mvc\View\Renderer;

class HTML extends AbstractRenderer {  
                      
	private $_content;                    
	
	public function __construct($str) {
		if (file_exists($str)) {
			$this->_content = file_get_contents($str);
		} else {
			$this->_content = $str;
		}
	}

	public function exec() {
		return "<html>".$this->_content."</html>";
	}

}

?>