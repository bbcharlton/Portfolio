<?php

class Auth extends AppController {

	public function __construct($parent) {
		$this->parent = $parent;
	}

	public function login() {
 	
		// if (@$_POST["name"] && @$_POST["password"]) {

		// 	if (@$_POST["name"] == "root" && @$_POST["password"] == "root") {

		// 		$_SESSION["loggedIn"] = 1;
		// 		header("Location:/Home");

		// 	} else {
		// 		header("Location:/Home?msg=Bad Login");
		// 	}

		// } else {
		// 	header("Location:/Home?msg=Bad Login");
		// }

		// $myfilestring = fopen("./assets/logins.text", "r");

		// if ($myfilestring) {

		// 	foreach(file("./assets/logins.text") as $line) {

		// 		$arr = explode("|", $line);

		// 		if ($_POST["name"] == $arr[0] && $_POST["password"] == $arr[1]) {
		// 			$_SESSION["loggedIn"] = 1;
		// 			$_SESSION["content"] = $arr[2];
		// 			header("Location:/Profile");
		// 			break;
		// 		} else if ($_POST["name"] == $arr[3] && $_POST["password"] == $arr[4]) {
		// 			$_SESSION["loggedIn"] = 1;
		// 			header("Location:/Profile");
		// 			echo $arr[5];
		// 			break;
		// 		} else {
		// 			header("Location:/Home?msg=Bad Login");
		// 		}
		// 	}

		// } else {
		// 	header("Location:/Home?msg=Bad Login");
		// }

		if ($_REQUEST["name"] && $_REQUEST["password"]) {
			$data = $this->parent->getModel("users")->select("select * from users where email = :email and password = :password", array(":email"=>$_REQUEST["name"], ":password"=>sha1($_REQUEST["password"])));
		
			if ($data) {
				$_SESSION["loggedIn"] = 1;
				header("Location:/Profile");
			} else {
				header("Location:/Home?msg=Bad Login");
			}

		}

	}

	public function logout() {
		session_destroy();
		header("Location:/Home");
	}

}

?>