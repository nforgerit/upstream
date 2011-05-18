<?php
$GLOBALS["L"]->load("abstractPageController");

class ListController extends AbstractPageController {


	public function singleAction($params) {

		echo "<h3>WOOHOO. THIS IS THE PAGE OF THE ENTRY.</h3>";
		echo "<hr style=\"width:100%;\" >";
die ("we are in singleaction");
		echo "The param 's name is {$params}";

		echo "<span style=\"color:#111;\">Lorem ipsum... bla bla bla</span>";
	}
}