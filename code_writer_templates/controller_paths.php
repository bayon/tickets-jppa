<?php
//unset($controller_final_filepath);
$directory = "./" . strtolower($objectName) . "/";
//APPROPRIATE:
if ($appropriateDirectory) {
	//$directory = "includes/controllers/". $objectName . "/";
	$directory = "includes/controllers/";
}
$controller_final_filepath = $OS_FILE_PATH . $directory .= strtolower($objectName) . ".controller.php";
echo("\n\$controller_final_filepath: " . $controller_final_filepath);
//---WRITE
$fp = fopen($controller_final_filepath, "w") or die("Couldn't open $controller_final_filepath");
//array of properties to comma separated parameters
//$arrayOfPropertiesToString = implode(',', $arrayOfProperties);
?>