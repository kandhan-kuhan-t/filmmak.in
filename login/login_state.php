<?php
session_start();
if(!$_SESSION['login'] == true){
	$val = true;
}
else{
	$val = false;
}
echo json_encode($val);
?>