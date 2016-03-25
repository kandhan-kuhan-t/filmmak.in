<?php
$val = 0;
mysql_connect("localhost","root","Kandha26$") or die(mysql_error());
mysql_select_db("filmak") or die(mysql_error());

$query = "select 1 from users where username = 'kuhan' and password = '123'";

$query_run = mysql_query($query);

$result = mysql_fetch_array($query_run);

if($result[0] == '1'){

	$val = 1;
}

echo $val;
?>