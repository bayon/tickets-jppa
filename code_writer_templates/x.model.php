<?php
//PHP MODEL---////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	unset($model_final_filepath);
	$directory = "./" . strtolower($objectName) . "/";
	if($appropriateDirectory){
	 $directory = "includes/models/";
	}
	$model_final_filepath = $OS_FILE_PATH . $directory .= $objectName . ".model.php";
	echo("\n\$model_final_filepath: ".$model_final_filepath);
	//---WRITE
	$fp = fopen($model_final_filepath, "w") or die("Couldn't open $model_final_filepath");
	//array of properties to comma separated parameters
	$arrayOfPropertiesToString = implode(',', $arrayOfProperties);
	fwrite($fp,"<?php \ninclude_once('mySQLi.model.php');");
	fputs($fp, "\n\nclass " . $objectName . " extends Model  { \n\n");
	fclose($fp);
	//----APPEND
	$fp = fopen($model_final_filepath, "a") or die("Couldn't open $model_final_filepath");
	//LOOP PROPERTIES
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp, "\tprivate $" . $arrayOfProperties[$x] . ";\n");
	}
	//CONSTRUCT
	fputs($fp,"\n\tfunction __construct(){
		parent::__construct();
	} ");
	fputs($fp,"\n\tpublic function model_connect() {
		return parent::connect();
	}");
	
	fputs($fp, "\n\tfunction init(");
	//PROPERTIES
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		if ($x == 0) {
			fputs($fp, "$" . $arrayOfProperties[$x]);
		} else {
			fputs($fp, ",$" . $arrayOfProperties[$x]);
		}
	}
	//END
	fputs($fp, "){\n");
	//DEFINE PROPERTIES
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp, "\t\t\$this -> " . $arrayOfProperties[$x] . " = $" . $arrayOfProperties[$x] . ";\n");
	}
	//END
	fputs($fp, "\t} \n");
	// GETTERS & SETTERS
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp, "\tpublic function set_" . $arrayOfProperties[$x] . "($" . $arrayOfProperties[$x] . "){\n");
		fputs($fp, "\t\t\$this -> " . $arrayOfProperties[$x] . " = $" . $arrayOfProperties[$x] . ";\n\t}\n");
		fputs($fp, "\tpublic function get_" . $arrayOfProperties[$x] . "(){\n");
		fputs($fp, "\t\treturn \$this -> " . $arrayOfProperties[$x] . "; \n\t}\n");
	}
	// USE CASE(instantiate via POST array)
	fputs($fp, "\n//---USE CASE (instantiate via POST array)---------------\n//\$" . strtolower($objectName) . " = new " . $objectName . "(");
	for ($x = 0; $x < $max; $x++) {
		if ($x == 0) {
			fputs($fp, " \$_POST['" . $arrayOfProperties[$x] . "']");
		} else {
			fputs($fp, ", \$_POST['" . $arrayOfProperties[$x] . "']");
		}
	}
	fputs($fp, "); \n");
	// -----READ-----------------------
	 fputs($fp,"
	 \n\tpublic function read(\$return = \"\") {
		\$con = \$this -> model_connect();
		\$sql = \" SELECT * FROM \" . \$this -> getDatabase() . \".".strtolower($objectName)." ;\";
		\$data = \$this -> exe_sql(\$con, \$sql, \$return);
		return \$data;
	 \n\t} ");
	 
	 
	 // -----READ ID-----------------------
	 fputs($fp,"
	 \n\tpublic function read_id(\$id = \"\",\$return = \"\") {
		\$con = \$this -> model_connect();
		\$sql = \" SELECT * FROM \" . \$this -> getDatabase() . \".".strtolower($objectName)." WHERE id='.\$_data;\";
		\$data = \$this -> exe_sql(\$con, \$sql, \$return);
		return \$data;
	 \n\t} ");


	fputs($fp,"\n\tpublic function read_parent_id(\$id = \"\",\$return = \"\") {
        \$con = \$this -> model_connect();
        \$sql = \" SELECT * FROM \" . \$this -> getDatabase() . \".".strtolower($childName)." WHERE parent_id='\$id';\";
        
        \$data = \$this -> exe_sql(\$con, \$sql, \$return);
        return \$data;
    \n\t} ");
	 

/*
	public function readByParentId($id = "",$return = "") {
        $con = $this -> model_connect();
        $sql = " SELECT * FROM " . $this -> getDatabase() . ".galaxy WHERE parent_id='$id';";
        
        $data = $this -> exe_sql($con, $sql, $return);
        return $data;
    
	} 
	*/
	fputs($fp,"\npublic function readByParentId(\$id='',\$return='') { ");
	fputs($fp,"\n\t \$con = \$this -> model_connect();    ");
	fputs($fp,"\n\t  \$sql = \" SELECT * FROM \" . \$this -> getDatabase() . \".".strtolower($objectName)." WHERE parent_id='\$id';\";  ");
	fputs($fp,"\n\t     \$data = \$this -> exe_sql(\$con, \$sql, \$return);  ");
	fputs($fp,"\n\t  return \$data;  ");
	
	fputs($fp,"\n }");


	  // -----   READ PARENT ID  -----------------------
	/* fputs($fp,"
	 \n\tpublic function read_ParentId(\$parent_id = \"\",\$return = \"\") {
		\$con = \$this -> model_connect();
		\$sql = \" SELECT * FROM \" . \$this -> getDatabase() . \".".strtolower($objectName)." WHERE id='.\$parent_id;\";
		\$data = \$this -> exe_sql(\$con, \$sql, \$return);
		return \$data;
	 \n\t} ");
	
	 
	 fputs($fp," \n\t	public function read_ParentId(\$parent_id = '',\$return = '') { \n "); 
fputs($fp,"		\$con = \$this -> model_connect(); \n  "); 
fputs($fp," 		  //SUBSTITUTE CORRECT CLASS  \n "); 
fputs($fp,"		\$sql = ' SELECT * FROM ' . \$this -> getDatabase() . '.child WHERE parent_id='. \$parent_id .'; ';  \n "); 
fputs($fp,"		\$data = \$this -> exe_sql(\$con, \$sql, \$return);  \n "); 
fputs($fp,"		return \$data;  \n "); 
fputs($fp,"	}  \n  "); 
	  */
	 
	 fputs($fp,"public function read_ModelKV(\$model='',\$k = '',\$v='',\$return = '') { \n "); 
fputs($fp," 		\$con = \$this -> model_connect(); \n  "); 
fputs($fp,"  		\$sql = ' SELECT * FROM ' . \$this -> getDatabase() . '.' . \$model . ' WHERE ' . \$k . '=' . \$v . '; ';  \n  "); 
fputs($fp," 		\$data = \$this -> exe_sql(\$con, \$sql, \$return);  \n  "); 
fputs($fp," 		return \$data; \n   "); 
fputs($fp," 	} \n   "); 
	 
	 
	 
	 
	 
	 
	 
	// SQL INSERT-----------------------------------------------------------------------------
	fputs($fp, "\n//---SQL INSERT -------------------------------\n");
	 fputs($fp,"
	 \n\tfunction create(\$" . strtolower($objectName) . ",\$return = \"json\") {
		\$con = \$this -> model_connect();");
		
		fputs($fp, "\n\t\t\$sql = \"INSERT INTO \".\$this -> getDatabase().\"." . strtolower($objectName) . " (");
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		if ($x == 0) {
			fputs($fp, "" . $arrayOfProperties[$x]);
		} else {
			fputs($fp, "," . $arrayOfProperties[$x]);
		}
	}
	fputs($fp, ")\n\t\tVALUES(");
	for ($x = 0; $x < $max; $x++) {
		if ($x == 0) {
			fputs($fp, "'\".\$" . strtolower($objectName) . "->get_" . $arrayOfProperties[$x] . "().\"' ");
		} else {
			fputs($fp, ", '\".\$" . strtolower($objectName) . "->get_" . $arrayOfProperties[$x] . "().\"' ");
		}
	}
	fputs($fp, ");\"; ");
		
		fputs($fp,"\n\t\$data = \$this -> exe_sql(\$con,\$sql, \$return);
		 // in the case of an insert , the return data will be the \"last id inserted\".
		echo(\$data);
	 \n\t } ");
	//SQL UPDATE-----------------------------------------------------------------------------
	 fputs($fp,"
	 function update(\$" . strtolower($objectName) . ",\$return = \"json\") {
		\$con = \$this -> model_connect();");
	fputs($fp, "\n\t\t\$sql = \"UPDATE \".\$this -> getDatabase().\"." . strtolower($objectName) . " set ");
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		if ($x == 0) {
			fputs($fp, "" . $arrayOfProperties[$x] . " = '\".\$" . strtolower($objectName) . "->get_" . $arrayOfProperties[$x] . "().\"' ");
		} else {
			fputs($fp, ", " . $arrayOfProperties[$x] . " = '\".\$" . strtolower($objectName) . "->get_" . $arrayOfProperties[$x] . "().\"' ");
		}
	}
	fputs($fp, " WHERE ");
	fputs($fp, "id = \".\$" . strtolower($objectName) . "->get_id().\"\";");
	fputs($fp,"	\n\t\t\$data = \$this -> exe_sql(\$con, \$sql, \$return);
 		echo(\$data);
	}
	 ");
	fputs($fp,"
	function delete(\$" . strtolower($objectName) . ",\$return = \"json\"){
		\$con = \$this -> model_connect();
		\$sql = \"DELETE FROM \" . \$this -> getDatabase() . \"." . strtolower($objectName) . " WHERE id = \" . \$" . strtolower($objectName) . " -> get_id() . \"  ;\";
		\$data = \$this -> exe_sql(\$con, \$sql, \$return);
		echo(\$data);
	}
	");
	//SQL CREATE TABLE------------------------------------------------------------------------------varchar(20)
fputs($fp,"function create_table_" . strtolower($objectName) . "(){" );
fputs($fp,"\n\t\t\$con = \$this -> model_connect();");
fputs($fp, "\n\t\t\$sql = \" CREATE TABLE IF NOT EXISTS ");
$create_script ="CREATE TABLE IF NOT EXISTS ";
	fputs($fp, "`" . strtolower($objectName) . "`" . " (");
	$create_script .="`" . strtolower($objectName) . "`" . " (";
	for ($x = 0; $x < $max; $x++) {
		if ($x == 0) {
			fputs($fp, "`" . $arrayOfProperties[$x] . "`" . " bigint(20) NOT NULL AUTO_INCREMENT");
			$create_script .="`" . $arrayOfProperties[$x] . "`" . " bigint(20) NOT NULL AUTO_INCREMENT";
			fputs($fp, ", PRIMARY KEY" . "(`" . $arrayOfProperties[$x] . "`)");
			$create_script .=", PRIMARY KEY" . "(`" . $arrayOfProperties[$x] . "`)";
		} else {
			fputs($fp, ", `" . $arrayOfProperties[$x] . "`  tinytext NOT NULL");
			$create_script .=", `" . $arrayOfProperties[$x] . "`  tinytext NOT NULL";
		}
	}
	fputs($fp, ")\n\t\t ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; \" ;\n");
	$create_script .=") ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1  ;";


fputs($fp,"\n\t\t\$data = \$this -> exe_sql(\$con, \$sql, \$return);");
fputs($fp,"\n}");
	// END CLASS
	fputs($fp, "\n\t }\n?>\n\n");
	fclose($fp);
	echo('<h3>PHP MODEL and SQL</h3>');
	echo("<BR>".$create_script."<BR>");
	echo("<br>INCLUDE mySQLi.model.php</br>");
	include_once('includes/models/mySQLi.model.php');
	echo("<br>INCLUDED mySQLi.model.php SUCCESSFULLY </br>");
	//$_POST['host'];
	echo('<br>host, username, password, and db </br>');
echo('<pre>');
	print_r($_POST);
	echo('</pre>');

/*
$con = $this -> model_connect();
		$sql =  "";
	$data = $this -> exe_sql($con,$sql, $return);
*/
	//OR
/*
L E F T    O F F  H E R E   

$con = mysqli_connect($this -> host, $this -> username, $this -> password);
$res = mysqli_query($con, $sql);
		
		if (mysqli_connect_errno())
		  {
		  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
		   $result_e =  "Failed to connect to MySQL: " . mysqli_connect_error();
		  return ($result_e );
		  }
		  
		if (gettype($res) == "boolean") {
			//INSERT creates a boolean for $res
			//return last id
			return mysqli_insert_id($con);
		}
*/
/*
$codewriter = new codewriter();
$data = $codewriter-> read('json');
echo($data);
*/
$codewriter = new codewriter();
echo('<br>INSTANTIATE MODEL CREATOR</br>');
$data = $codewriter-> writeTable($create_script);
echo('<br>sql response:</br>');
echo($data);
echo("<br>ANY LUCK !</br>");

//FAIL-------------------------------------------------
/*
	 mysql_connect($_POST['host'],$_POST['username'],$_POST['password']);
	 mysql_db_query($_POST['db'],$create_script);

	 echo('<br>CHECK mySQL fro NEW TABLE.</br>');
	echo(mysql_error());
	//echo("data result:".$data);
	*/
	
	showCode($model_final_filepath);
	
	echo("<pre>");print_r($_POST);echo("</pre>");
