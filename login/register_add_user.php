<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$profile_name = $request->profile_name;

$password = $request->password;

$username = $_SESSION['username_register'];

$query1 = "update users set password = '$password',
		   					profile_name = '$profile_name'
 		   where username = '$username'";

mysqli_query($conn,$query1);

$query2 = "insert into users_profile(username,profile_name) values('$username','$profile_name')";

mysqli_query($conn,$query2);

?>