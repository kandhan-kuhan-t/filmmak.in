<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$search_string = $_SESSION['search_string'];
$query = "select * from videos where title like '%$search_string%'";
$query_run = mysqli_query($conn,$query);
$results = [];
$i = 0;
while($result = mysqli_fetch_assoc($query_run)){
	$results[$i]['title'] = $result['title'];
	$results[$i]['videoID'] = $result['videoID'];
	$results[$i]['description'] =$result['description'];
	$results[$i]['views'] = $result['views'];
	$i++;
}
echo json_encode($results);
?>