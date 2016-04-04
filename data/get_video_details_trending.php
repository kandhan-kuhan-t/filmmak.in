<?php
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$sql = "select  videoID,title,description,genre from videos where timestampdiff(second,curdate(),upload_date)/(24*60*60) < 7 order by views desc";
$query_run = mysqli_query($conn,$sql);
$i = 0;
$response = array();
while($result = mysqli_fetch_array($query_run)){
$response[$i]['videoID'] = $result[0];
$response[$i]['title'] = $result[1];
$response[$i]['description'] = $result[2];
$response[$i]['genre'] = $result[3];
$i++;
}
echo json_encode($response);
?>