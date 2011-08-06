<?php                  
namespace my\blog;

class IndexController extends \my\Mvc\AbstractPageController {

	public $var1 = 'hello';
	public $var2 = "moto";
	
	public function muhAction() {
		echo "MOOOOOOOHH";
	}
	
	public function indexAction() {
		echo "HOORAY!! WE'RE IN INDEX ACTION!";
		
		echo "This is my fancy new blog entry. YEAH!";   
	}                     
	
	public function hellomotoAction() {
		echo "In HelloMotoAction";
		echo "<pre>";
			var_dump($GLOBALS["C"]->getConfigSection("defaultRoute"));
			die("died in ".__METHOD__." -- line ".__LINE__);
		echo "</pre>";
		
	}
}
