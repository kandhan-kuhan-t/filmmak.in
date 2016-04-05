<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $_SESSION['username'];
$videoID = $request->videoID;
$title = $request->title;
$description = $request->description;
$genre = $request->genre;
$duration = $request->duration;
$query = "insert into videos(username,videoID,title,description,genre,duration) values('$username','$videoID','$title','$description','$genre','$duration')";
$query_run = mysqli_query($conn,$query) or die(mysqli_connect_error());
$val = 1;
$_SESSION['upload_videoID'] = $videoID;
echo json_encode($val);
?>