<?php
include_once("../AbstractTestcase.php");

class RequestTest extends AbstractTestcase {

	private $RequestMock;

	public static function SetUpBeforeClass() {
		AbstractTestcase::assertTrue(file_exists("../../classes/Utility/Request.php"));
		include_once("../../classes/Utility/Request.php");
	}

	public function setUp() {
		$this->RequestMock = new Request();
		$this->assertNotNull($this->RequestMock);
	}

	public function testMuh() {
		echo "Muh macht die controller kuh";
	}

	private function setupRequestMock() {
		$this->RequestMock = (object) array (
			"client_ip" => "111.111.111.1",
			"client_browser" => "Firefox/0.9.3",
			"method"	=> "GET",
			"time"	=>	"11111111111",
			"query"	=>	"/muh/macht/die/kuh"
			
		);
	}
}