<?php

class Profile extends AppController {

	public function __construct() {

		if (@$_SESSION["loggedIn"] && @$_SESSION["loggedIn"] == 1) {

		} else {
			header("Location:/Home");
		}


		$nav = array("Home"=>array("Home","/Home"),
					"Gallery"=>array("Gallery","/Gallery"),
					"About"=>array("About","/About"),
					"API"=>array("API","/API/gb")
		);

		$this->getView("header", $nav);

	}

	public function index(){
 	
		echo 'This is a protected page!' . "<br>";
		echo $_SESSION["content"];
	}

}



?>