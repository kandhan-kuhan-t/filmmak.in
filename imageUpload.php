<?php

$file_tmp =$_FILES['file']['tmp_name'];

$file_name = $_REQUEST['videoID']."jpg";

move_uploaded_file($file_tmp,"images/".$file_name) or die("ERROR");

$response = 1;

echo json_encode($response);

?>