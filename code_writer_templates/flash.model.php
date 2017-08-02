<?php
//PHP MODEL---////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	unset($model_final_filepath);
	$directory = "./" . $objectName . "/";
	if($appropriateDirectory){
	 $directory = "includes/models/";
	}
	$model_final_filepath = $OS_FILE_PATH . $directory .= $objectName . ".model.php";
	echo("\n\$model_final_filepath: ".$model_final_filepath);
	//---WRITE
	$fp = fopen($model_final_filepath, "w") or die("Couldn't open $model_final_filepath");
	//array of properties to comma separated parameters
	$arrayOfPropertiesToString = implode(',', $arrayOfProperties);
	fwrite($fp,"package  { \n ");
	fputs($fp, "\n\npublic class " . $objectName . "    { \n\n");
	fclose($fp);
	//----APPEND
	$fp = fopen($model_final_filepath, "a") or die("Couldn't open $model_final_filepath");
	//LOOP PROPERTIES
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp, "\t var  _" . $arrayOfProperties[$x] . ":String;\n");
	}
	//CONSTRUCT
	fputs($fp, "\n\tpublic function " . $objectName . "(");
	//PROPERTIES
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		if ($x == 0) {
			fputs($fp, "" . $arrayOfProperties[$x].":String");
		} else {
			fputs($fp, "," . $arrayOfProperties[$x].":String");
		}
	}
	//END
	fputs($fp, "){\n");
	//DEFINE PROPERTIES
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp, "\t\t _" . $arrayOfProperties[$x] . " = " . $arrayOfProperties[$x] . ";\n");
	}
	//END
	fputs($fp, "\t} \n");
	// GETTERS & SETTERS
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp, "\tpublic function set_" . $arrayOfProperties[$x] . "(new_" . $arrayOfProperties[$x] . ":String):void{\n");
		fputs($fp, "\t\t  _" . $arrayOfProperties[$x] . " =  new_" . $arrayOfProperties[$x] . ";\n\t}\n");
		fputs($fp, "\tpublic function get_" . $arrayOfProperties[$x] . "():String {\n");
		fputs($fp, "\t\treturn  _" . $arrayOfProperties[$x] . "; \n\t}\n");
	}
 
	  fputs($fp, "\n\t }\n\n\n");
	// END CLASS
	fputs($fp, "\n}\n\n\n");
	fclose($fp);
	/*
	echo('<h3>FLASH MODEL  </h3>');
	echo("<BR>".$create_script."<BR>");
	include_once('includes/models/mySQLi.model.php');
	//$_POST['host'];
	 mysql_connect($_POST['host'],$_POST['username'],$_POST['password']);
	 mysql_db_query($_POST['db'],$create_script);
	echo(mysql_error());
	 * 
	 */
	//echo("data result:".$data);
	
	
	showCode($model_final_filepath);
	
	echo("<pre>");print_r($_POST);echo("</pre>");
