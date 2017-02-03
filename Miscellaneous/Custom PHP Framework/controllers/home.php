<?php

class Home extends AppController {
	public function __construct() {

	}

	public function index(){
 		$nav = array("Home"=>array("Home","/Home"),
					"Gallery"=>array("Gallery","/Gallery"),
					"About"=>array("About","/About"),
					"API"=>array("API","/API/gb")
		);

		$random = substr( md5(rand()), 0, 7);

		$this->getView("header", $nav);
		$this->getView("front-page");

		$this->getView("footer", array("cap"=>$random));
	}
}

?>