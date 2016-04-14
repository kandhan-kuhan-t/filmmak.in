<?php
session_start();
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$_SESSION['search_string'] = $request->search_string;
$_SESSION['search_type'] = $request->searchType;
?>