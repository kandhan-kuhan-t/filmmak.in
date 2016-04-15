<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$username = $_SESSION['view_username'];

$query = "select users_profile.*,contact_number,email_id,access from users_profile join contact on contact.username = users_profile.username having username = '$username'";



$query_run = mysqli_query($conn,$query);

$result = mysqli_fetch_assoc($query_run);

$response['profile_name'] = $result['profile_name'];
$response['gender'] = $result['gender'];
$response['field'] = $result['field'];
$response['about'] = $result['about'];
$response['experience'] = $result['experience'];
$response['dob'] = $result['dob'];
$response['contact_number'] = $result['contact_number'];
$response['email_id'] = $result['email_id'];
$response['access'] = $result['access'];
$response['username'] = $result['username'];

echo json_encode($response);
?>