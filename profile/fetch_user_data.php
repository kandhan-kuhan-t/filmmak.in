<?php
session_start();
$conn = mysqli_connect("localhost","root","Kandha26$","filmak") or die(mysqli_connect_error());
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->username;
$query = "select profile.*,contact_number,email_id from profile join contact on contact.username = profile.username having username = '$username'";
$query_run = mysqli_query($conn,$query);
$result = mysqli_fetch_assoc($query_run);
echo json_encode($result);
?>