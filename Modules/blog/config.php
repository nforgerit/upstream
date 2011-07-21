<?php
$config = array(
	"defaultRoute"	=>	array(
		"controller"	=>	"index",
		"action"	=>	"hellomoto",
	),                                 
	"routes"	=> array(
		"standard"	=>	array(               
			"priority"	=>	0,
			"pattern"	=>	"/blog/:name",
			"requestParams"	=>	array(
				'module' 	=> 'blog', 
				'controller' 	=> 'list',
				'action'	=> 'single',
				'params'	=> array(
					':name'	=> '/^[a-zA-Z]([-_.]?[a-zA-Z0-9]+)+/'
				),
			"source"	=>	__FILE__,
			),
		),
	),
);
