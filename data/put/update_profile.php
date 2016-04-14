<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $_SESSION['username'];
$name = $request->profile_name;
$gender = $request->gender;
$field = $request->field;
$date_of_birth = $request->date_of_birth;
$experience = $request->experience;
$about = $request->about;
$query = "update users_profile
set profile_name = '$name',
gender = '$gender',
field = '$field',
dob = '$date_of_birth',
experience = '$experience',
about = '$about'
where username = '$username'
";
echo '<script>console.log($scope.date_of_birth)</script>';
$query_run = mysqli_query($conn,$query);
?>