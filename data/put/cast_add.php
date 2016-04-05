<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$member_name = $request->member_name;

$field = $request->field;

$isMember = $request->isMember;

$videoID = $_SESSION['upload_videoID'];

//$videoID = 'test';

$query = "insert into casting(videoID,member_name,field,isMember) values('$videoID','$member_name','$field', $isMember) ";

mysqli_query($conn,$query) or die();

?>
