<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$user = [];
$user[0] = $_SESSION['username'];
$user[1] = $_SESSION['name'];
echo json_encode($user);
?>