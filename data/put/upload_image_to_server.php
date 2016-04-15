<?php

$file_tmp =$_FILES['file']['tmp_name'];

$file_name = $_REQUEST['videoID'];

// Get new sizes
list($width, $height) = getimagesize($file_tmp);
$newwidth = 200;
$newheight = 200;

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($file_tmp);

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
imagejpeg($source,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/original".$file_name.".jpg") or $response['status']="ERROR UPLOADING IMAGE";


imagejpeg($thumb,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/images/".$file_name.".jpg") or $response['status']="ERROR UPLOADING IMAGE";
$response['status'] = 1;

echo json_encode($response);

?>