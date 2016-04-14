<?php

$file_tmp =$_FILES['file']['tmp_name'];

$size = getimagesize($_FILES['file']['tmp_name']);

$width = $size[0];

$height = $size[1];

$response['status'] = 0;

if($width != $height){

	$response['status'] = "Incorrect Dimensions";

}
else{
	
	$response['status'] = 1;
}


echo json_encode($response);

?>