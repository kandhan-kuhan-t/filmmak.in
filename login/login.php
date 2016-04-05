<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$username = $request->username;

$password = $request->password;

$query = "select 1,profile_name from users where username = '$username' and password = '$password'";

$query_run = mysqli_query($conn,$query);

$result = mysqli_fetch_row($query_run);

$val = [];
$val[0] = 0;

if($result[0] == '1'){

	$val[0] = 1;
	$val[1] = $result[1];
	$_SESSION['username'] = $username;
	$_SESSION['name'] = $result[1];

}

echo json_encode($val);
?>