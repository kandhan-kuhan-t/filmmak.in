<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$username = $_SESSION['view'];
$query = "select profile.*,contact_number,email_id from profile join contact on contact.username = profile.username having username = '$username'		";
$query_run = mysqli_query($conn,$query);
$result = mysqli_fetch_assoc($query_run);
echo json_encode($result);
?>