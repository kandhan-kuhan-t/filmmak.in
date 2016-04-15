<?php
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->username;
$passcode = "";
$response['status'] = 1;
for($i=2;$i<12;$i++){
$number = rand(0,25);
//$i%2==0?$password[$i]=chr($number+97):$password[$i]=chr($number+65);
$i%2==0?$passcode.=chr($number+97):$passcode.=chr($number+65);
}
$query = "insert into password_recovery(username,passcode) values('$username','$passcode')";

if(!mysqli_query($conn,$query))$response['status'] = "A mail has already been sent to you";

echo json_encode($response);
?>
