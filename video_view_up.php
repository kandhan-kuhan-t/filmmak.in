<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$videoID = $request->videoID;
$query = "update videos set views = views + 1 where videoID = '$videoID'";
mysqli_query($conn,$query);
?>