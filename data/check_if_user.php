<?php

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$member_name = $request->member_name;

$query = "select 1 from users where username = '$member_name'";

$query_run = mysqli_query($conn,$query);

$result = mysqli_fetch_row($query_run);

$response;

if($result[0] == "1"){

	$response = 1;
}

else
{
	$response = 0;
}

echo json_encode($response);

?>