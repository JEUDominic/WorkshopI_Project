<?php
header('Content-Type: text/xml');
$con = mysql_connect("119.29.106.147","esdc","123456");
if (!$con){
	die('Could not connect: ' . mysql_error());
}
$d_idd = $_GET["t"];

$sql2 = "SELECT * FROM `ESDC`.`raw_data` ORDER BY `d_id` DESC  LIMIT 0,1";
$result2=mysql_query($sql2,$con);
$row2 = mysql_fetch_row($result2);
//echo $row2[0]."222222";
if(($row2[0]) < ($d_idd))
{
	$d_idd = $row2[0];
	// exit(0);
}

$sql = "SELECT * FROM `ESDC`.`raw_data` WHERE d_id='".$d_idd."'";
$result=mysql_query($sql,$con);
$row = mysql_fetch_row($result);
echo mysql_error();
if($row==FALSE){
	die( 'row2:'. $row2[0]."d_idd:".$d_idd. mysql_error());
}
else{
	echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
	echo "<tr>
	<td>".$row[0]."</td>
	<td>".$row[1]."</td>
	<td>".$row[2]."</td>
	<td>".$row[3]."</td>
	<td>".sprintf("%f",$row[4])."</td>
	<td>".sprintf("%f",$row[5])."</td>
	<td>".sprintf("%f",$row[6])."</td>
	<td>".$row[7]."</td>
	<td>".$row[8]."</td>
	<td>".$row[9]."</td>
	<td>".$row[10]."</td>
	<td>".$row[11]."</td>
	</tr>";
}
mysql_close($con);	
?>
