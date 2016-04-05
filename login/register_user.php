<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$username = $request->username;

$_SESSION['username_register'] = $username;

$query = "insert into users(username) values('$username')";

mysqli_query($conn,$query);

?>