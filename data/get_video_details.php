<?php
mysql_connect("localhost","root","Kandha26$") or die(mysql_error());
mysql_select_db("filmak") or die(mysql_error());
$sql = "select videoID,title,description,genre from videos";
$query_run = mysql_query($sql) or die(mysql_error());
$i = 0;
$response = array();
while($result = mysql_fetch_array($query_run)){
$response[$i]['videoID'] = $result[0];
$response[$i]['title'] = $result[1];
$response[$i]['description'] = $result[2];
$response[$i]['genre'] = $result[3];
$i++;
}
echo json_encode($response);
?>