<?php

session_start();
class AppController {
	public function __construct($urlPathParts, $config) {

		$this->db = new PDO("mysql:dbname=" . $config["dbname"] . ";", $config["dbuser"], $config["dbpass"]);

		$this->urlPathParts = $urlPathParts;

		if($urlPathParts[0] == "assets") {
            
            include $urlPathParts;

        } else {

			if($urlPathParts[0]) {
				include './controllers/'.$urlPathParts[0].".php";

				$appcon = new $urlPathParts[0]($this);

				if(isset($urlPathParts[1])) {
					$appcon->$urlPathParts[1]();
				} else {
					$methodVariable = array($appcon, 'index');

					if(is_callable($methodVariable, false, $callable_name)) {
						$appcon->index($this);
					}
				}
			} else {
				include 'controllers/'.$config["defaultController"].".php";
			
				$appcon = new $config["defaultController"]($this);
			
				if(isset($urlPathParts[1])) {
					$appcon->config["defaultController"][1]();
				} else {
					$methodVariable = array($appcon, 'index');
					
					if(is_callable($methodVariable, false, $callable_name)) {
						$appcon->index($this);
					}
				}
			}
		}
	}

	public function getView($page, $data = array()) {
		require_once './views/'.$page.".php";
	}

	public function getModel($page) {
		require_once './models/'.$page.".php";
		$model = new $page($this);
		return $model;
	}
}

?>