<?php
 /*============================================================*/
/*-----	AUTOMATED CONFIGS	 ---------------------------------*/
/*============================================================*/
//FBF
$site_root ="jppa/tickets-jppa";
//SHOUT
//$site_root ="/communitywall";
//site root is every path segment after HOST and PORT . ie. localhost:8888

//$site_root ="00_CommunityWall/REMOTE/CommunityWall";
define('BASE_PATH', realpath(dirname(__FILE__)));
$domain = $_SERVER['HTTP_HOST'];
$hostname = $domain . "/" . $site_root . "/";
define('BASE_URL', 'http://' . $hostname . '');



?>
