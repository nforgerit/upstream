<?php
$config = array(
	"defaultRoute"	=>	array(
		"controller"	=>	"index",
		"action"		=>	"hellomoto",
	),                                 
	"routes"	=> array(
		"standard"	=>	array(
			"pattern"	=>	"/:module/:controller/:action",
			"requestParams"	=>	array(
				'module'        => ':module',
				'controller'    => ':controller',
				'action'        => ':action',
				'params'        => array(),
			"source"	=>	__FILE__,
			),
		),
		"short_version"	=>	array(
			"pattern"	=>	"/default",
			"requestParams"	=>	array(
				"module"		=>	"default",
				"controller"	=>	"index",
				"action"		=>	"index",
				"params"		=>	array(),
			"source"	=>	__FILE__,
			),
		),
	),
);

/*
 pattern => /blog/list/#current
 pattern => /blog/list/#first
 pattern => /blog/list/#current-13
 pattern => /blog/fancy-name-of-blog-entry
*/
 