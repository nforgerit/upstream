<?php
$config = array(
	"defaultRoute"	=>	array(
		"controller"	=>	"index",
		"action"	=>	"save",
	),                                 
	"routes"	=> array(
		"standard"	=>	array(               
			"priority"	=>	0,
			"pattern"	=>	"/rest/:name",
			"requestParams"	=>	array(
				'module' 	=> 'blog', 
				'controller' 	=> 'crud',
				'action'	=> 'single',
				'params'	=> array(
					':name'	=>	'/^[a-zA-Z]([-_.]?[a-zA-Z0-9]+)+(\/)?/',
				),
			"source"	=>	__FILE__,
			),
		),
	),
);