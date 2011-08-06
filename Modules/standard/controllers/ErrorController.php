<?php  
namespace my\standard;

class ErrorController extends \my\Mvc\AbstractPageController {   
   
	public function __construct() {
		echo "<h6>Ooops.. obviously an error has occured </h6>";
	}                       
	
	public function notFound_404Action() { 
	}
}
