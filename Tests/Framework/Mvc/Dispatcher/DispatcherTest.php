<?php
include_once("AbstractTestcase.php");

class DispatcherTest extends AbstractTestcase {

	private $ControllerMock;

	public static function setUpBeforeClass() {
		AbstractTestcase::assertTrue(file_exists(CMS_ROOT."/Framework/Classes/Mvc/Dispatcher/Dispatcher.php"));
		include_once(CMS_ROOT."/Framework/Classes/Mvc/Dispatcher/Dispatcher.php");		
	}
	
	public function setUp() {
		$this->DispatcherMock = new Dispatcher();
		$this->assertTrue($this->DispatcherMock !== NULL);
	}

	public function testMuh() {
	}

}
	
