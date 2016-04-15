<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$profile_name = $request->profile_name;

$display_name = $request->display_name;

$password = $request->password;

$sha_password = sha1($password);

$username = $_SESSION['username_register'];

$query1 = "insert into users(username,password,profile_name) values('$username','$sha_password','$profile_name');";

$query1 .= "insert into users_profile(username,profile_name,display_name) values('$username','$profile_name','$display_name')";

$source_cover = imagecreatefrompng($_SERVER['DOCUMENT_ROOT']."/filmmak.in/cover.png");

imagejpeg($source_cover,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/coverpic/".$username.".jpg");

$source_profile =  imagecreatefrompng($_SERVER['DOCUMENT_ROOT']."/filmmak.in/profile.png");

imagejpeg($source_profile,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/profilepic/".$username.".jpg");

mysqli_multi_query($conn,$query1);

?>