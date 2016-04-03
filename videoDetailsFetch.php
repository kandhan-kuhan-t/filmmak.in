<?php
session_start();
$videoID = $_SESSION['videoID'];
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$query = "select * from videos where videoID = '$videoID'";
$query1 = "select member from casting where videoID = '$videoID'";
$query1_run = mysqli_query($conn,$query1);
$query_run = mysqli_query($conn,$query);
$result = mysqli_fetch_array($query_run);
$result1 = array();
$i = 0;
while($response = mysqli_fetch_row($query1_run)){
	
		$result1['cast'][$i++] = $response[0];
}
$results = array();
$results[0] = $result;
$results[1] = $result1;
echo json_encode($results);
?>