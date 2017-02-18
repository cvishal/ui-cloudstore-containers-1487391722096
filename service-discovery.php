<?php
//$services = getenv("VCAP_SERVICES");
//$services_json = json_decode($services, true);

// Get Service Discovery token and url from the env variables
//$sdToken = $services_json["service_discovery"][0]["credentials"]["auth_token"];
//$sdURL = $services_json["service_discovery"][0]["credentials"]["url"];

// Call the Service Discovery service to retrieve urls for our Catalog and Orders apps
//function getAPIRoute($apiName){
//	global $sdToken, $sdURL;
//	$sdGetServicePath = "/api/v1/services/" . $apiName;
//	$response = request("GET", $sdURL . $sdGetServicePath, $sdToken);
//	return json_decode($response, true)["instances"][0]["endpoint"]["value"];
//}

// Send a http request using curl
function request($httpMethod, $url, $token = null){
	console.log("Inside Request "+$url);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $httpMethod);
	curl_setopt($curl, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
	curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
	// Set bearer authorization token if passed in
	if (!is_null($token)){
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token));
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	console.log("Executing  curl_exec "+$curl);
	$result = curl_exec($curl);
	if ($result === FALSE) {
		die(curl_error($curl));
	}
	curl_close($curl);
	console.log("Done  curl_exec "+$result);
	
	return $result;
}
?>
