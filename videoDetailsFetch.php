<?php
session_start();
//if(!$_SESSION['user_id']){
//header('location:home.html');
//die;
//}
$videoID = $_SESSION['videoID'];
$conn = mysqli_connect("localhost","root","Kandha26$","filmak") or die(mysqli_connect_error());
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