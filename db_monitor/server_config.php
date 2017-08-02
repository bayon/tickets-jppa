<?php
//require_once(dirname(__DIR__).'/constants.php');
require_once('constants.php');
//LOCAL CONFIG===============
$host = HOST;
$user = USERNAME;
$pass = PASSWORD;
$db = DATABASE;
$tbl = TABLE;
$date_field = DATE_FIELD;
//============================
if(1 == 1){
	// showing these errors could mess up the ajax return data.
	error_reporting(0);
	@ini_set('display_errors', 0);
	error_reporting(E_ERROR);
}

?>
