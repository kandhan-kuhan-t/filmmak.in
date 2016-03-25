<?php
require_once dirname(__FILE__).'/googlePHP/src/Google/autoload.php';

$client = new Google_Client();
$client->setApplicationName('filmakin');
$client->setDeveloperKey('AIzaSyCCnmu1kcu1DQtb9t1cA0WVNBn2RCQGStI');
$youtube = new Google_Service_YouTube($client);
$videoId = $_REQUEST['videoId'];


   $listResponse = $youtube->videos->listVideos("contentDetails",
        array('id' => $videoId));
   if (empty($listResponse)) {
      printf('<h3>Can\'t find a video with video id: </h3>');
    }
   $video = $listResponse[0];
   echo $video['contentDetails']['duration'];


?>