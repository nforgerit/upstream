<?php
$config = array(
	"defaultRoute"	=>	array(
		"controller"	=>	"index",
		"action"	=>	"hellomoto",
	),                                 
	"routes"	=> array(
		"standard"	=>	array(               
			"priority"	=>	0,
			"pattern"	=>	"/blog/:year/:month/:name",
			"requestParams"	=>	array(
				'module' 	=> 'blog', 
				'controller' 	=> 'list',
				'action'	=> 'single',
				'params'	=> array(
					':name'	=>	'/^[a-zA-Z]([-_.]?[a-zA-Z0-9]+)+(\/)?/',
					':year'	=>  '/^2[0-9]{3}/',
					':month'=>	'/^0[1-9]|1(1|2)/',
				),
			"source"	=>	__FILE__,
			),
		),
	),
);
