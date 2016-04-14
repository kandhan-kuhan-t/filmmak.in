<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$username = $_SESSION['username'];
$query = "select users_profile.*,contact_number,email_id,access from users_profile join contact on contact.username = users_profile.username having username = '$username'";
$query_run = mysqli_query($conn,$query);
$result = mysqli_fetch_assoc($query_run);
echo json_encode($result);
?>