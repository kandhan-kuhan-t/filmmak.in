<?php
session_start();
$videoID = $_SESSION['videoID'];
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$query = "select * from videos where videoID = '$videoID'";
$query1 = "select member_name from casting where videoID = '$videoID' and isMember = 1";
$query1_run = mysqli_query($conn,$query1);
$query_run = mysqli_query($conn,$query);
$result = mysqli_fetch_array($query_run);
$result1 = array();
$i = 0;
while($response = mysqli_fetch_assoc($query1_run)){
	
		$result1['member_name'][$i] = $response['member_name'];
		$i++;
}
$results = array();
$results[0] = $result;
$results[1] = $result1;
echo json_encode($results);
?>