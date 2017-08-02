<?php

//unset($view_new__final_filepath);
	$directory = "./" . $objectName . "/";
	if($appropriateDirectory){
	 $directory = "includes/views/". $objectName . "/";
	}
	$view_list_final_filepath = $OS_FILE_PATH . $directory .= $objectName . ".view.php";
	//echo("\n\$view_new__final_filepath: ".$view_new__final_filepath);
	echo($view_list_final_filepath);
	//---WRITE
	$fp = fopen($view_list_final_filepath, "w") or die("Couldn't open $view_list_final_filepath");
	//array of properties to comma separated parameters
	//$arrayOfPropertiesToString = implode(',', $arrayOfProperties);
	
	?>