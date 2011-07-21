<?php
//$GLOBALS["L"]->load("abstractPageController");

class IndexController {

	public $var1 = 'hello';
	public $var2 = "moto";
	
	public function muhAction($params) {
		echo "MOOOOOOOHH";

		echo "<pre>";
		var_dump ($params);
		echo "</pre>";
	}
	
	public function indexAction($params) {
		echo "HOORAY!! WE'RE IN INDEX ACTION!";

		echo "<pre>";
		var_dump ($params);
		echo "</pre>";		
	}                     
	
	public function hellomotoAction($params) {
		echo "In HelloMotoAction";
		echo "<pre>";
		var_dump ($params);
		echo "</pre>";                
		
		echo "<pre>";
			var_dump($GLOBALS["C"]->getConfigSection("defaultRoute"));
			die("died in ".__METHOD__." -- line ".__LINE__);
		echo "</pre>";
		
	}
}
