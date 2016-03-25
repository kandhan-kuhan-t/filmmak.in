<?php
mysql_connect("localhost","root","Kandha26$") or die(mysql_error());
mysql_select_db("filmak") or die(mysql_error());
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->username;
$videoID = $request->videoID;
$title = $request->title;
$description = $request->description;
$genre = $request->genre;
$query = "insert into videos values('$username','$videoID','$title','$description','$genre')";
$query_run = mysql_query($query) or die(mysql_error());
$val = "DONE";
echo json_encode($val);
?>