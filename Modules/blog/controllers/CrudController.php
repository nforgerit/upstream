<?php    
namespace my\blog;

class CrudController extends \my\Mvc\AbstractPageController {     
	
	
	public function singleAction() {		        
		$args = $this->_dispatcher->getRequest()->args();    		  
		$filedir = CMS_ROOT."/Web/writable/private";
		$filepath = "blogentries/".date("Y")."/".date("m");
		$filename = $args['name'];
		$fileending = "xml";
		
		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			@mkdir($filedir."/".$filepath, 0777, true);
			@file_put_contents("{$filedir}/{$filepath}/{$filename}.{$fileending}", file_get_contents($_FILES['file']['tmp_name']));

			die("\n-- File '{$filename}.xml´ successfully written.\n\n");
		} else if ($_SERVER['REQUEST_METHOD'] === "GET") {
			echo file_get_contents("{$filedir}/{$filepath}/{$filename}.{$fileending}");			
		}		
	}
}