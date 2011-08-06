<?php             
namespace my\standard;

class IndexController extends \my\Mvc\AbstractPageController {

	public $var1 = 'hello';
	public $var2 = "moto";
	
	public function muhAction() {
		echo "MOOOOOOOHH";

		echo "<pre>";
		var_dump ($this);
		echo "</pre>";
	}
	
	public function indexAction() {
		echo "HOORAY!! WE'RE IN INDEX ACTION!";

		echo "<pre>";
		var_dump ($this);
		echo "</pre>";		
	}                     
	
	public function hellomotoAction() {
		echo "In HelloMotoAction";
		echo "<pre>";
		var_dump ($this);
		echo "</pre>";                
		
		echo "<pre>";
			var_dump($GLOBALS["C"]->getConfigSection("defaultRoute"));
			die("died in ".__METHOD__." -- line ".__LINE__);
		echo "</pre>";
		
	}
}
