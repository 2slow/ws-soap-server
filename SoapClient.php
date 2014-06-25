<?php
//TEST CLIENT FILE; DELETE THIS BEFORE USING IN PRODUCTION

// Setup autoloading
require 'init_autoloader.php';

// Change path to match config
$path = 'http://localhost/workspace/github/ws-soap-server/';

$client = new Zend\Soap\Client($path."SoapServer.php?wsdl", array('soap_version' => SOAP_1_2));

// $result1 is a string
$result = $client->get_comments_by_parent_id(1640);

// id is a string, must start with a letter
$addComment = $client->add_comment("id5", 1645, "Jean-Louiiiis", 5, "c etait pas terrible");

echo "<pre>";
var_dump($result);
echo "</pre>";

echo "<pre>";
var_dump($addComment);
echo "</pre>";
