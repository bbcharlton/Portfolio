<?php

include 'appcontroller.php';

class App {
	public function __construct($config) {
		$this->config = $config;
	}

	public function startApp($params) {
		$AppController = new AppController($params, $this->config);
	}
}

?>