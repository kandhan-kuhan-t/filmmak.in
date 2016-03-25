<?php
require_once dirname(__FILE__).'/googlePHP/src/Google/autoload.php';
mysql_connect("localhost","root","Kandha26$") or die(mysql_error());
mysql_select_db("filmak") or die(mysql_error());

$client = new Google_Client();
$client->setApplicationName('filmakin');
$client->setDeveloperKey('AIzaSyCCnmu1kcu1DQtb9t1cA0WVNBn2RCQGStI');
$youtube = new Google_Service_YouTube($client);

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$videoID = $request->videoID;



   $listResponse = $youtube->videos->listVideos("contentDetails",
        array('id' => $videoID));
  /* if (empty($listResponse)) {
   	$val = "NO";
      //echo json_encode($val);
    }
    else{
    	$val = "YES";
   $video = $listResponse[0];
   //echo json_encode($video['contentDetails']['duration']);

}

echo json_encode($video['contentDetails']['duration']);
*/
$video = $listResponse[0];
if($video['contentDetails'] == null){
	$response = "NO SUCH VIDEO";
	echo json_encode($response);
	exit;
}
else{
	$duration = $video['contentDetails']['duration'];
	$sql = "update videos set duration = '$duration' where videoID = '$videoID'";
	$query_run = mysql_query($sql) or die(mysql_error());
	$response = "DURATION ADDED to MySQL";
	echo json_encode($response);
}

?>