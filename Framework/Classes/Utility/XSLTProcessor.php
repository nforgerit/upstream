<?php       
namespace my\Utility;
  
class XSLTProcessor {
	
	private $_inputData;
	private $_outputData;
	private $_styleSheet;
	
	public function injectInputData(DOMDocument $inp) {
		$this->_inputData = $inp;
	}                                                      
	
	public function injectStylesheet(DOMDocument $xsls) {
		$this->_styleSheet = $xsls;
	}
	
	public function render() {
		try {
			$xsltproc = new XSLTProcessor;
			$xsltproc->importStylesheet($this->_styleSheet);
			$this->_outputData = $xsltproc->transformToXML($this->_inputData);
			
			return $this->_outputData;
		} catch (Exception $e) {
			print "Could not process the Datafile with the given Stylesheet: " . $e->getMessage();
		}
	}

}
?>