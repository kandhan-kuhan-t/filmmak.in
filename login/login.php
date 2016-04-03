<?php
session_start();
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->username;
$password = $request->password;

mysql_connect("localhost","root","Kandha26$") or die(mysql_error());
mysql_select_db("filmak") or die(mysql_error());

$query = "select 1,name from users where username = '$username' and password = '$password'";

$query_run = mysql_query($query);

$result = mysql_fetch_array($query_run);
$val = [];
if($result[0] == '1'){

	$val[0] = 1;
	$val[1] = $result[1];
	$_SESSION['username'] = $username;
	$_SESSION['name'] = $result[1];

}

echo json_encode($val);
?>