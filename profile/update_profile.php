<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $_SESSION['username'];
$name = $request->profile_name;
$gender = $request->gender;
$field = $request->field;
$birth_year = $request->birth_year;
$experience = $request->experience;
$birth_date = $request->birth_date;
$about = $request->about;
$query = "update profile
set name = '$name',
gender = '$gender',
field = '$field',
birth_year = '$birth_year',
birth_date = '$birth_date',
experience = '$experience',
about = '$about'
where username = '$username'
";
$query_run = mysqli_query($conn,$query);
?>