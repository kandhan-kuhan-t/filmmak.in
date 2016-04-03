<?php
session_start();
$conn = mysqli_connect("localhost","root","Kandha26$","filmak") or die(mysqli_connect_error());
$search_string = $_SESSION['search_string'];
$query = "select * from videos where title like '%$search_string%'";
$query_run = mysqli_query($conn,$query);
$results = [];
$i = 0;
while($result = mysqli_fetch_assoc($query_run)){
	$results[$i]['title'] = $result['title'];
	$results[$i]['videoID'] = $result['videoID'];
	$i++;
}
echo json_encode($results);
?>