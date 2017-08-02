<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
require_once('server_config.php');
if(isset($_GET)){
    $con = mysqli_connect($host,$user,$pass);
//".$date_field."
    $sql = "SELECT * FROM ".$db.".".$tbl."";
    //echo($sql);die();
    $res = mysqli_query($con,$sql);
    $data = "";
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo(json_encode($data));
}
?>
