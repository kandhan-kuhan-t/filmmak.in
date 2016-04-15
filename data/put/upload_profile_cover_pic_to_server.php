<?php

$file_tmp =$_FILES['file']['tmp_name'];

$file_name = $_REQUEST['username'];

$type = $_REQUEST['type'];

if($type == 'profile'){

// Get new sizes
	list($width, $height) = getimagesize($file_tmp);
	$newwidth = 300;
	$newheight = 300;

// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromjpeg($file_tmp);

// Resize
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
	$response['status'] = 1;
	imagejpeg($source,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/profilepic/original/".$file_name.".jpg") or $response['status']=error_get_last();
	imagejpeg($thumb,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/profilepic/".$file_name.".jpg") or $response['status']=error_get_last();

	$response['username'] = $file_name;
	$response['filepath'] = $_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/profilepic/".$file_name.".jpg";
	echo json_encode($response);

}

else if($type == 'cover'){

	list($width, $height) = getimagesize($file_tmp);
	$newwidth = 1094;
	$newheight = 310;

// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromjpeg($file_tmp);

// Resize
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
	$response['status'] = 1;
	imagejpeg($source,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/coverpic/original/".$file_name.".jpg") or $response['status']=error_get_last();
	imagejpeg($thumb,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/coverpic/".$file_name.".jpg") or $response['status']=error_get_last();

	$response['username'] = $file_name;
	$response['filepath'] = $_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/coverpic/".$file_name;
	echo json_encode($response);


}

?>