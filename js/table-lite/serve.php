<?php
header('content-type: application/json; charset=utf-8');
mysql_connect('localhost', 'root', '');
$sql = "SELECT * FROM saintx.powerlifting";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
	$data[] = $row;
}
$json = json_encode($data);
$filename = "data5.json";
fileIt($filename,$json);

//Write Data to JSON file
function fileIt($filename,$json) {
	$fp = fopen($filename, "a") or die("Couldn't open $filename");
	fputs($fp, $json);
	fclose($fp);
}

?>