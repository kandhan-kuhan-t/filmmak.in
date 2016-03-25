<?php

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->username;
$password = $request->password;

mysql_connect("localhost","root","Kandha26$") or die(mysql_error());
mysql_select_db("filmak") or die(mysql_error());

$query = "select 1 from users where username = '$username' and password = '$password'";

$query_run = mysql_query($query);

$result = mysql_fetch_array($query_run);

if($result[0] == '1'){
	
	$val = 1;
}

echo json_encode($val);
?>