<?php
$config = array(
	"defaultRoute"	=>	array(
		"controller"	=>	"index",
		"action"		=>	"hellomoto",
	),                                 
	"routes"	=> array(
		"route1"	=>	array(
			"pattern"	=>	"/:module/:controller/:action",
		),
		"route2"	=>	array(
			"pattern"	=>	"/:module/:controller",
		),
	),
);