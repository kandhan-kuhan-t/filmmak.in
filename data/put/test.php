<?php
$source = imagecreatefrompng($_SERVER['DOCUMENT_ROOT']."/filmmak.in/cover.png");

imagejpeg($source,$_SERVER['DOCUMENT_ROOT']."/filmmak.in/"."test".".jpeg") or $response['status']=error_get_last();
?>