<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$username = $request->username;

$query = "select 1 from users where username = '$username'";

$query_run = mysqli_query($conn,$query);

$query_result = mysqli_fetch_assoc($query_run);

$isUser = $query_result['1'];


if($isUser != '1'){

$_SESSION['username_register'] = $username;

$response['status'] = 1;

echo json_encode($response);

}

else{

	$response['status'] = 0;

	echo json_encode($response);
}



/*$query = "insert into users(username) values('$username')";

mysqli_query($conn,$query) or die(0);

$response['status'] = 1;

echo json_encode($response);
*/

?>