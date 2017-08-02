<html>
	<?php 
	include_once("constants.php"); 
	require_once("./includes/models/codewriter.model.php");

	?>

	<head>
		<title>Code Writer</title>
		
		<style>
			body {
				margin:0;
				font-family:arial;
				margin:0;
				text-align:center;
			}
			#form_container {
				margin-top:25px;
				text-align:left;
				width:80%;
				margin-left:20%;
			}
			.list_input {
				width:400px;
			}
			input, select, textarea {
				margin-bottom:20px;
			}
			label {
				color:#333
			}
		</style>
	</head>
	<body>
		<h1>Code Writer</h1>
		<a href="index.php">back</a>
		<p>Write The Tables To MySQL !!!! Don't forget. </p>
		<p>ALso...only Master Tables in Main Navigation </p>
		<p>Awesome, now just need to see items I just added, there's a parent id getting overwitten somewhere...but I've drilled down three levels...</p>
		<div id="form_container">
			<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> >
				 
				
				<label>host</label>
				<input type = "text" name="host" placeholder="host" value="<?php echo(HOST); ?>"> </input>
				<label>username</label>
				<input type = "text" name="username" placeholder="username" value="<?php echo(USERNAME); ?>"> </input>
				<label>password</label>
				<input type = "text" name="password" placeholder="password" value="<?php echo(PASSWORD); ?>"> </input>
				<label>db</label>
				<input type = "text" name="db" placeholder="database" value="<?php echo(DATABASE); ?>"> </input>
				<hr>
				<label>Name the object</label></br>
				<input type = "text" name="objectname" placeholder="Object Name" value="BigObj">
				</input>
				</br>
				<label>Name the child object</label>
				<input type = "text" name="childname" placeholder="Child Name" value="LittleObj">
				</input>

				</br>
				<label>List of Properties(comma separated)</label></br>
				<input type = "text" class="list_input" name="arrayOfProperties" placeholder="comma separated Properties" value="id, parent_id, name, thing1, thing2">
				</input></br>
				
				<label>List of Methods(comma separated)</label></br>
				<input type = "text" class="list_input" name="arrayOfMethods" placeholder="comma separated  Methods" value="init" >
				</input></br>
				<label>Place in appropriate directory?</label>
				<input type="checkbox" class="" name="placeAppropriateDirectory" >
				</input></br>
				<input type="submit" value="write file" >
				</input>
				
			</form>
			<hr>
			<h3>DEV NOTES:</h3>
				need default ORDER BY field for pagination view!</br>
				pagination search method FAILS, controller does not have method 'paginate'</br>
				<hr>
		</div>
	</body>
</html>
<?php
define('BASE_PATH', realpath(dirname(__FILE__)));
define('OS_TYPE', 'mac');
 
// mac or pc
$props = explode(',', preg_replace('/\s+/', '', $_POST['arrayOfProperties']));
$meths = explode(',', preg_replace('/\s+/', '', $_POST['arrayOfMethods']));

if(isset($_POST)){
	define('CW_DB',$_POST['database']);
	define('CW_U',$_POST['username']);
	define('CW_P',$_POST['password']);
}

$filePath_mac = "file://" . BASE_PATH . "/";
$filePath_pc = "C:/" . BASE_PATH . "/";
$CODE_OBJECT = "anything for now";
$objectName = strtolower($_POST['objectname']);
$childName = strtolower($_POST['childname']);
$arrayOfProperties = $props;
$arrayOfMethodNames = $meths;

$appropriateDirectory = false;
if(isset($_POST['placeAppropriateDirectory'])){
	if($_POST['placeAppropriateDirectory'] == "on"){
		$appropriateDirectory = true;
	}
}
if (OS_TYPE == "mac") {
	$OS_FILE_PATH = $filePath_mac;
	$includes_filepath = $OS_FILE_PATH."/includes/main.php";
	$navigation_filepath = $OS_FILE_PATH."/includes/views/nav_includes.php";
} else {
	$OS_FILE_PATH = $filePath_pc;
	$includes_filepath = $OS_FILE_PATH."/includes/main.php";
	$navigation_filepath = $OS_FILE_PATH."/includes/views/nav_includes.php";
}
$directory = "./" . strtolower($objectName) . "/";
// only create directory if needed.
if(!$appropriateDirectory){
	if (!mkdir($directory, 0777, true)) {
		die('Failed to create folders...');
	}
}else{
	 
	/*THIS WOULD CREATE A SEPARATE DIR FOR CONTROLLERS, not necessary.
	 * if (!mkdir("includes/controllers/".$directory, 0777, true)) {
		die('Failed to create folders...');
	}*/
	if (!mkdir("includes/views/".$directory, 0777, true)) {
		die('Failed to create folders...');
	}else{
		echo('<br>CREATED FOLDERS : SUCCESSFULLY</br>');
	}
}
//CONTROLLER---////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($CODE_OBJECT != "nonsense") {
	echo('<br>INCLUDING: CONTROL CODE </br>');
	include_once('code_writer_templates/x.controller.php');
}
//MODEL---////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($CODE_OBJECT != "nonsense") {
	echo('<br>INCLUDING: MODEL CODE </br>');
	include_once('code_writer_templates/x.model.php');	
}
//VIEW---////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($CODE_OBJECT != "nonsense") {
	echo('<br>INCLUDING: VIEW CODE </br>');
	//include_once('code_writer_templates/x.pagination.view.php');
	include_once('code_writer_templates/x.tablelite.view.php');
	//include_once('code_writer_templates/x.js.module.php');
}
 
function showCode($page) {
	$codeToHTML = new CodeToHtml;
	$codeToHTML -> viewCode($page);
}
class CodeToHtml {
	public function viewCode($page) {
		$code = htmlspecialchars(file_get_contents($page));
		echo("<style> .codeViewClass{
									background:black;
									text-align:left;
									color:green;
									height:500px;
									overflow-y:scroll;
									width:90%;
									margin-left:5%;
									margin-top:15px;
									} </style>");
		echo("<div class='codeViewClass'><pre>" . $code . "</pre></div>");
	}

}
?>
