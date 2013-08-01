<?php

set_time_limit(0);

require_once('nusoap.php');
 
$url = "http://localhost/soapWS/soapserver.php?wsdl";
 
$client = new nusoap_client($url);
 
$err = $client->getError();
 
if ($err) {
    echo '<p><b>Error: ' . $err . '</b></p>';
}
 
 
$return = $client->call('generateArrayNames', array('name' => 10000));
 


echo "<p>Value returned from the server is: " . $return . "</p>";

// Display the request and response
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . $client->response . '</pre>';
// Display the debug messages
echo '<h2>Debug</h2>';
echo $client->debug_str;
 