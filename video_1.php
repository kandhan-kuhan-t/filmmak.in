<?php
mysql_connect("localhost","root","Kandha26$") or die(mysql_error());
mysql_select_db("filmak") or die(mysql_error());
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$url = $request->url;

//$sql = "select * from videos where videoID = '$url'" ;
//$query_run = mysql_query($sql) or die(mysql_error());

echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/$url" frameborder="0" allowfullscreen></iframe>';

echo $url;

?>