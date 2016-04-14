<?php

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$member_name = $request->member_name;

$query = "select 1,profile_name from users where username = '$member_name'";

$query_run = mysqli_query($conn,$query);

$result = mysqli_fetch_assoc($query_run);

$response;

if($result['1'] == "1"){

	$response['status'] = 1;
	$response['profile_name'] = $result['profile_name'];

}

else
{
	$response = 0;
}

echo json_encode($response);

?>