<?php

class ErrorController {   
   
	public function __construct() {
		echo "<h6>Ooops.. obviously an error has occured </h6>";
	}                       
	
	public function notFound_404Action() { 
		echo "<pre style=\"font-size:300%;\">";
		echo "For this request, you deserve three numbers. <br>";
		echo "</pre>";     
		
		echo "<span style=\"font-size:28em;color:#FF00FF\">4  0  4</span>";
	}
}
