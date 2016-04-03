<?php
session_start();

$conn = mysqli_connect("localhost","root","Kandha26$","filmak") or die(mysqli_connect_error());
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $_SESSION['username'];
$contact_number = $request->contact_number;
$email_id = $request->email_id;
$query = "update contact
set 
contact_number = '$contact_number',
email_id = '$email_id'
where 
username = '$username'
";
$query_run = mysqli_query($conn,$query);
if($query_run){
	$val = "CONTACT UPDATED";
	echo json_encode($val);
}
?>
