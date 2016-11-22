<?php 
ini_set("display_errors", "Off"); 
$con = mysql_connect("119.29.106.147","esdc","123456");
if (!$con){
	die('Could not connect: ' . mysql_error());
}

$sql2 = "SELECT * FROM `ESDC`.`raw_data` ORDER BY `d_id` DESC  LIMIT 0,1";
$result2=mysql_query($sql2,$con);
$row2 = mysql_fetch_row($result2);
echo $row2[0] - 15;











?>