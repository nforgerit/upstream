<?php

define("CMS_ROOT", dirname(__FILE__)."/../");                          

include_once(CMS_ROOT."/Framework/Classes/Bootstrap/Bootstrap.php");   

Framework_Classes_Bootstrap_Bootstrap::getInstance()
	->injectConfig(CMS_ROOT."/Framework/Meta/config.php")
    ->startMvc();
       