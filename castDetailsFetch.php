<?php
session_start();
$videoID = $_SESSION['videoID'];
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$query = "select member_name,isMember from casting where videoID = '$videoID' and isMember = 0";
$query1 = "select member_name,profile_name from casting join users on member_name = username where isMember = 1 and videoID = '$videoID'";
$query_run1 = mysqli_query($conn,$query1);
$query_run = mysqli_query($conn,$query);
$response = [];
$i = 0;
while($result = mysqli_fetch_assoc($query_run)){

	$response[$i]['member_name'] = $result['member_name'];
	$response[$i]['isMember'] = $result['isMember'];
	$i++;
}
$i = 0;
$response1 = [];
while($result = mysqli_fetch_assoc($query_run1)){

	$response1[$i]['profile_name'] = $result['profile_name'];
	$response1[$i]['member_name'] = $result['member_name'];
	$i++;
}
$responses = [];
$responses[0] = $response;
$responses[1] = $response1;
echo json_encode($responses);
?>