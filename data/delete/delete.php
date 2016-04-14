<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$videoID = $_SESSION['upload_videoID'];
$query = "delete from videos where videoID = '$videoID'";
mysqli_query($conn,$query);
?>