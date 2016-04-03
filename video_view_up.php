<?php
session_start();
$conn = mysqli_connect("localhost","root","Kandha26$","filmak") or die(mysqli_connect_error());
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$videoID = $request->videoID;
$query = "update videos set views = views + 1 where videoID = '$videoID'";
mysqli_query($conn,$query);
?>