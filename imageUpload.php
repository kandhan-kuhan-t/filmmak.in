<?php

$file_tmp =$_FILES['file']['tmp_name'];
 $file_name = $_FILES['file']['name'];
 move_uploaded_file($file_tmp,"images/".$file_name) or die("EROR");

echo json_encode($file_name);

?>