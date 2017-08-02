<?php
if ($appropriateDirectory) {
	$i_fp = fopen($includes_filepath, "a") or die("Couldn't open $includes_filepath");
	// fputs to includes/main.php
	fputs($i_fp, "\nrequire_once \"includes/controllers/" . strtolower($objectName). ".controller.php\";");
	fputs($i_fp, "\nrequire_once \"includes/models/" . strtolower($objectName) . ".model.php\";");
	fclose($i_fp);
	
	
	//$n_fp = fopen($navigation_filepath);
	$n_fp = fopen($navigation_filepath, "a") or die("Couldn't open $navigation_filepath");
	// fputs to includes/views/nav_includes.php
	
	fputs($n_fp,"\n".$menu_item);
	//fputs($n_fp, "\nrequire_once \"includes/controllers/" . ucfirst($objectName) . ".controller.php\";");
	//fputs($n_fp, "\nrequire_once \"includes/models/" . ucfirst($objectName) . ".model.php\";");
	fclose($n_fp);
}
?>