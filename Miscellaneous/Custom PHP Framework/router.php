<?php

include 'bin/app.php';

class Router {
	public function __construct($urlPathParts, $config) {
		$this->App = new App($config);
		switch ($urlPathParts[0]) {
			case 'home':
				$this->App->startApp($urlPathParts);
				break;

			case 'api':
				$this->App->startApp($urlPathParts);
				break;
			
			default:
				$this->App->startApp($urlPathParts);
				break;
		}
	}
}

?>