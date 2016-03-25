<?php
require_once dirname(__FILE__).'/googlePHP/src/Google/autoload.php';
echo "!";
$client = new Google_Client();
$client->setApplicationName('filmakin');
$client->setDeveloperKey('AIzaSyCCnmu1kcu1DQtb9t1cA0WVNBn2RCQGStI');
$youtube = new Google_Service_YouTube($client);
echo $client;
echo "1";


?>