<?php
session_start();
$val = 0;
if(isset($_SESSION['username'])){
	$val = 1;
	echo json_encode($val); 
}
else{
	echo json_encode($val);
}
?>