<?php       
namespace my\blog;

class BlogEntry implements \my\Mvc\View\Renderer\RenderingObjectInterface {      
	
	private $_request;     
	private $_args;                          
	
	private $_dataFile;
	private $_stylesheetFile;
	
	public function __construct(\my\Mvc\Request $req) {        	
		$this->_request = $req;	 
		$this->_args = $this->_request->args();           
		$this->_sanitizeArgs();                 
		
	   	$this->_dataFile = CMS_ROOT."/Web/writable/private/blogentries/{$this->_args['year']}/{$this->_args['month']}/{$this->_args['name']}".".xml";           
	   	$this->_stylesheetFile = CMS_ROOT.'/Modules/blog/data/private/xsltstylesheet.xsl';
	}
	
	public function provideRenderer() {   
		try {  		
			$renderer = new \my\Mvc\View\Renderer\XSLT;
			$renderer->injectDatafile($this->_dataFile);
			$renderer->injectStylesheet($this->_stylesheetFile);   
		} catch (\Exception $e) {         
			$this->_request->make404();  
			return new \my\Mvc\View\Renderer\HTML(CMS_ROOT."/Modules/standard/views/404.phtml");
		}                                
		
		return $renderer;
	}             
	
	private function _sanitizeArgs() {   
		$expected_values = array(
			"year"	=>	"number_int",
			"month"	=>	"number_int",
			"name"	=>	"string",
		);  
		$sanitizer = new \my\Mvc\Sanitizer(
			$this->_request->args(),
            $expected_values
		);
		foreach ($expected_values as $k => $v) {
			$this->_args[$k] = $sanitizer->get($k);
		}
	}                           	            
}

?>
