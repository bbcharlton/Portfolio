<?php

class apiModel {
	public function __construct($parent) {
		$this->db = $parent->db;
	}

	public function googleBooks($term='') {
		$client = new Google_Client();
		$client->setApplicationName("sslapi");
		$client->setDeveloperKey("AIzaSyAw6KIuq6WKljuFC1p1CA2TVLwe6OKSjCM");
		
		$service = new Google_Service_Books($client);

		$optParams = array("filter"=>"free-ebooks");
		$result = $service->volumes->listVolumes($term, $optParams);

		return $result;
	}

	public function curl($url){
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_HEADER, 0);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	    curl_setopt($curl, CURLOPT_USERAGENT, 'cURL');
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($curl, CURLOPT_ENCODING , "gzip");//<< Solution

	    $result = curl_exec($curl);
	    curl_close($curl);

	    return $result;
	}
}

?>