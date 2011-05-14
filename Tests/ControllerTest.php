<?php
include_once("AbstractTestcase.php");

class ControllerTest extends AbstractTestcase {

	private $ControllerMock;

	public static function setUpBeforeClass() {
		AbstractTestcase::assertTrue(file_exists("../classes/Controller.php"));
		include_once("../classes/Controller.php");		
	}
	
	public function setUp() {
		$this->ControllerMock = new Controller();
		$this->assertTrue($this->ControllerMock !== NULL);
	}

	public function testMuh() {
	}

}
	