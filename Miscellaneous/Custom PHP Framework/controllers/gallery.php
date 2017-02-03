<?php

class Gallery extends AppController {
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
		$this->getView("gallery-page");

		$this->getView("footer", array("cap"=>$random));
 }

public function contactCheck() {
	// if (isset($_POST)){
	// 	header('Content-Type: application/json');
	// 	echo json_encode(array('name' => $_POST['name'], 'email' => $_POST['email'], 'message' => $_POST['message'], 'captcha' => $_POST['captcha']));

	// } else {
	// 	header('HTTP/1.1 500 Internal Server Error');
	// 	header('Content-Type: application/json; charset=utf8');
	// 	die(json_encode(array('msg'=>'ERROR')));
	// }

	if($_POST["captcha"] == $_SESSION["captcha_string"]){

		if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){

			echo "Email invalid";

		}else{

			echo "Email valid";

		}

	}else{

		echo "Invalid captcha";

	}

}

public function loginCheck() {

	// $myfilestring = fopen("./assets/logins.text", "r");

	// if ($myfilestring) {

	// 	foreach(file("./assets/logins.text") as $line) {

	// 		$arr = explode("|", $line);

	// 		if (strpos($line, $arr[0]) !== false && strpos($line, $arr[1]) !== false) {
	// 			echo $arr[2];
	// 		} else if (strpos($line, $arr[3]) !== false && strpos($line, $arr[5]) !== false) {
	// 			echo $arr[6];
	// 		}

	// 		echo "LOGIN SUCCESSFUL!";
	// 	}

	// } else {
	// 	echo "File not found!";
	// 	echo "LOGIN FAILED!";
	// }

	// if ($_POST["name"] == "root" && $_POST["password"] == "root") {
	// 	echo "LOGIN SUCCESSFUL!";
	// } else {
	// 	echo "LOGIN FAILED!";
	// }

}


}

?>