<?php

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->username;

$query = "select name from users where username = '$username'";
mysql_connect("localhost","root","Kandha26$") or die(mysql_error());
mysql_select_db("filmak") or die(mysql_error());
$query_run = mysql_query($query);
$result = mysql_fetch_array($query_run);
echo json_encode($result);
?>