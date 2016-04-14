<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$username = $request->username;

$password = $request->password;

$sha_password = sha1($password);

$query = "select 1,display_name from users inner join users_profile on users.username=users_profile.username where users.username = '$username' and users.password = '$sha_password'";

$query_run = mysqli_query($conn,$query);

$result = mysqli_fetch_assoc($query_run);

$val = [];
$val[0] = 0;

if($result['1'] == '1'){

	$val[0] = 1;
	$val[1] = $result[1];
	$_SESSION['username'] = $username;
	$_SESSION['name'] = $result['display_name'];

}

echo json_encode($val);
?>