<?php

$file_tmp =$_FILES['file']['tmp_name'];

$file_name = $_REQUEST['videoID']."jpg";
move_uploaded_file($file_tmp,"images/".$file_name) or die("ERROR");

echo json_encode($file_name);

?>