<?php

$config = array(
	"classes"	=> array(
		"Dispatcher"	=>	array(
			"name"	=>	"Dispatcher",
			"file"	=>	CMS_ROOT."/Framework/Classes/Mvc/Dispatcher/Dispatcher.php",
			"singleton"	=>	"true",	
		),  
		"AbstractPageController"	=>	array(
			"name"	=>	"AbstractPageController",
			"file"	=>	CMS_ROOT."/Framework/Classes/Mvc/Abstract/AbstractPageController.php",
			"abstract"	=>	"true",	
		),
		"Request"	=>	array(
			"name"	=>	"Request",
			"file"	=>	CMS_ROOT."/Framework/Classes/Mvc/Request/Request.php",
		), 
		"Response"	=>	array(
			"name"	=>	"Response",
			"file"	=>	CMS_ROOT."/Framework/Classes/Mvc/Response/Response.php",
			"singleton"	=>	"true",	
		),     
		"Route"	=>	array(
			"name"	=>	"Route",
			"file"	=>	CMS_ROOT."/Framework/Classes/Mvc/Routing/Route.php",
		),   
		"Router"	=>	array(
			"name"	=>	"Router",
			"file"	=>	CMS_ROOT."/Framework/Classes/Mvc/Routing/Router.php",  
			"singleton"	=>	"true",	
		),              
		"View"	=>	array(
			"name"	=>	"View",
			"file"	=>	CMS_ROOT."/Framework/Classes/Mvc/View/View.php",  
		),     
	),
	"meta"	=>	array(
		"defaultModule"		=>	"default",
		"defaultController"	=>	"index",
		"defaultAction"		=>	"index",
	),
	"modules"	=>	array(
		"1"	=>	array(
			"name"	=>	"default",
			"allowOverwriteRoutes"	=>	true,
		),                                  
		"2"	=>	array(
			"name"	=>	"blog",
			"allowOverwriteRoutes"	=>	false,
		),
	),
);
  
