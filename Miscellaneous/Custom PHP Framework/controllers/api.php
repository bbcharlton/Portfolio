<?php
	class API extends AppController {
		public function __construct($parent) {
			$this->parent = $parent;
		}

		public function ga() { //Google Auth
			include './google-api-php-client/src/Google/autoload.php'; 

			$client_id = '523145149737-pl5df58v4sh86i84qrk07e9eh7qa3vea.apps.googleusercontent.com'; 
			$client_secret = 'N6r8D7_p-DhL-T7D7DlV3mPx';
			$redirect_uri = 'http://127.0.0.1/API/ga';
			$client = new Google_Client();
			$client->setClientId($client_id);
			$client->setClientSecret($client_secret);
			$client->setRedirectUri($redirect_uri);
			$client->addScope("email");
			$client->addScope("profile");

			$service = new Google_Service_Oauth2($client);

			//var_dump($service);

			if (isset($_GET['code'])) {
				$client->authenticate($_GET['code']);
				$_SESSION['access_token'] = $client->getAccessToken();
				header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
				exit;
			}

			if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
				$client->setAccessToken($_SESSION['access_token']);
			} else {
				$authUrl = $client->createAuthUrl();
			}

			echo '<div style="margin:20px">';

			if (isset($authUrl)){ 
			    //show login url
			    echo '<div align="center">';
			    echo '<h3>Login with Google -- Demo</h3>';
			    echo '<div>Please click login button to connect to Google.</div>';
			    echo '<a class="login" href="' . $authUrl . '"><img src="images/google-login-button.png" /></a>';
			    echo '</div>';
			    
			} else {
			    
			    $user = $service->userinfo->get(); //get user info 
			    
			   	//print user details
			    echo '<pre>';
			    print_r($user);
			    echo '</pre>';
			}
			echo '</div>';

			echo "TEST";
		}

		public function gb() { //Google Books
			include './google-api-php-client/src/Google/autoload.php'; 

			$nav = array("Home"=>array("Home","/Home"),
					"Gallery"=>array("Gallery","/Gallery"),
					"About"=>array("About","/About"),
					"API"=>array("API","/API/gb")
			);

			$data = $this->parent->getModel("apiModel")->googleBooks("Henry David Thoreau");

			$random = substr( md5(rand()), 0, 7);

			$this->getView("header", $nav);
			$this->getView("api", $data);
			$this->getView("footer", array("cap"=>$random));
		}

		function stackO(){
		    $nav = array("Home"=>array("Home","/Home"),
					"Gallery"=>array("Gallery","/Gallery"),
					"About"=>array("About","/About"),
					"API"=>array("API","/API/gb")
			);

			$data = $this->parent->getModel("apiModel")->curl("https://api.stackexchange.com/2.2/questions?order=desc&sort=activity&site=stackoverflow");

			$random = substr( md5(rand()), 0, 7);

			$this->getView("header", $nav);
			$this->getView("api", $data);
			$this->getView("footer", array("cap"=>$random));
		}
	}

?>