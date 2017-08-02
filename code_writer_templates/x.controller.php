<?php
//PHP TIRE CONTROLLER---////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 require_once('controller_paths.php');
	///---->write the code here ---- -------------------------
	fputs($fp,"<?php
	//CONTROLLER TEMPLATE
	");
	fputs($fp,"\nclass " . strtolower($objectName) . "_controller {");
	fputs($fp,"\n\tprivate \$instanceName;");
	fputs($fp,"\n\tprivate \$view;");
	fputs($fp,"\n\tprivate \$view_dir;");
//	CONSTRUCT ----------------------------------------------------------------	
	fputs($fp,"\n\tfunction __construct() {");
	fputs($fp,"\n\t\t\$this -> instanceName = 'default';");
	fputs($fp,"\n\t\t\$this -> view = '" . strtolower($objectName) . ".view.php';");
	fputs($fp,"\n\t\t\$this -> view_dir = '" . strtolower($objectName) . "/';");
	fputs($fp,"\n\t}");
//	HOME ----------------------------------------------------------------
	fputs($fp,"\n\tpublic function home(\$_data) {");
	fputs($fp,"\n\t\t\$view=\$this -> view_dir.\"" . strtolower($objectName) . ".home.view.php\";");
	fputs($fp,"\n\t\t\$data = \$_data;");
	fputs($fp,"\n\t\t\$this->buildView(\$view,\$data);");
	fputs($fp,"\n\t}");
//	READ ----------------------------------------------------------------
	fputs($fp,"\n\tpublic function read(\$_data) {");
	fputs($fp,"\n\t\t \$_SESSION['parent_id'] = \$_SESSION['admin_id']; ");

	fputs($fp,"\n\t\t\$view=\$this -> view_dir.\"" . strtolower($objectName) . ".view.php\";");
	fputs($fp,"\n\t\t 
 		 \$" . strtolower($objectName) . " = new " . strtolower($objectName) . "();");
	fputs($fp,"\n 
		\$data = \$" . strtolower($objectName) . "-> read();");
	fputs($fp,"\n\t\t\$this->buildView(\$view,\$data);");
	fputs($fp,"\n\t}");
	
	
	 
	 
	 
	 
	 //	read_ModelKV : read model, key and value. ------------------------------------------ 
	 fputs($fp," public function read_ModelKV(\$_data) { \n "); 
	fputs($fp," 		\$className = \$_data['model']; \n  "); 
	fputs($fp," 		\$object = new \$className;  \n  "); 
	fputs($fp,"   		\$data = \$object-> read_ModelKV(\$_data['model'],\$_data['k'],\$_data['v'],'json');   \n  "); 
	fputs($fp,"  		echo(\$data);   \n  "); 
	fputs($fp,"  	 \n } "); 
		 
		 
	 
	 
	//	READTOJSON ----------------------------------------------------------------
	fputs($fp,"\n\tpublic function readToJSON() {");
	fputs($fp,"\n\t\t 
 		 \$" . strtolower($objectName) . " = new " . strtolower($objectName) . "();");
	fputs($fp,"\n 
		\$data = \$" . strtolower($objectName) . "-> read('json');");
	  fputs($fp,"\n\t\t echo(\$data);");
	fputs($fp,"\n\t}");
	

fputs($fp,"\n\tpublic function readToJSONByParentId(\$_data) {");


	fputs($fp,"\n\t\t 
 		 \$" . strtolower($objectName) . " = new " . strtolower($objectName) . "();");
	//readByParentId($_SESSION['parent_id'],'json');
	fputs($fp,"\n 
		\$data = \$" . strtolower($objectName) . "-> readByParentId(\$_SESSION['parent_id'],'json');");
	  fputs($fp,"\n\t\t echo(\$data);");
	

	fputs($fp,"\n\t}");





	//	READ_ID ----------------------------------------------------------------
	fputs($fp,"\n\tpublic function read_id(\$_data) {");
 	 //header('LOCATION: ?c=account_controller&m=paginate&where=where id='.$_data);
 	 fputs($fp,"\n\theader('LOCATION: ?c=".strtolower($objectName)."_controller&m=paginate&where=where id='.\$_data);");
	fputs($fp,"\n\t}");

///////////////////////////////////////////////////
fputs($fp,"	public function read_parent_id(\$_data) {
			\$view=\$this -> view_dir.\"".strtolower($objectName).".view.php\"; ");
	fputs($fp,"\$_SESSION['parent_id'] = \$_data['parent_id'];");
	fputs($fp," \$data = \$_data; ");
	fputs($fp,"	\$this->buildView(\$view,\$data);
	}");
	//////////////////////////////////////////////////





//	EDIT ----------------------------------------------------------------
	fputs($fp,"\n\tpublic function edit(\$_data) {");
	fputs($fp,"\n
		include_once(\"../models/" . strtolower($objectName) . ".model.php\");
		\$" . strtolower($objectName) . " = new " . strtolower($objectName) . "(); 
		\$" . strtolower($objectName) . "->init(");
		$max = count($arrayOfProperties);
		for ($x = 0; $x < $max; $x++) {
			if($x == 0){
				fputs($fp,"\$_data['" . $arrayOfProperties[$x] . "']");
			}else{
				fputs($fp,",\$_data['" . $arrayOfProperties[$x] . "']");
			}
		}
		 fputs($fp,");");
		fputs($fp,"\n\t\t\t\$" . strtolower($objectName) . "->set_id(\$_data['id']);
		\$" . strtolower($objectName) . " ->update(\$" . strtolower($objectName) . ");
		unset(\$" . strtolower($objectName) . ");");
	fputs($fp,"\n\t\t\$view=\$this -> view_dir.\"" . strtolower($objectName) . ".edit.view.php\";");
	fputs($fp,"\n\t\t\$data = \$_data;");
	fputs($fp,"\n\t\t\$this->buildView(\$view,\$data);");
	fputs($fp,"\n\t}");
//	CREATE ----------------------------------------------------------------
	fputs($fp,"\n\tpublic function create(\$_data) {");
	fputs($fp,"\n\t\t\$view=\$this -> view_dir.\"" . strtolower($objectName) . ".create.view.php\";");
	fputs($fp,"\n 
		 // include main includes for ajax only:
		include(\"../models/" . strtolower($objectName) . ".model.php\");
		\$" . strtolower($objectName) . " = new " . ucfirst($objectName) . "(); 
		\$" . strtolower($objectName) . "->init(");
		//LOOP PROPERTIES
		$max = count($arrayOfProperties);
		for ($x = 0; $x < $max; $x++) {
			if($x == 0){
				fputs($fp,"\$_data['" . $arrayOfProperties[$x] . "']");
			}else{
				//fputs($fp,",\$_data['" . $arrayOfProperties[$x] . "']");
				if($arrayOfProperties[$x] == "parent_id"){
					fputs($fp,",\$_SESSION['" . $arrayOfProperties[$x] . "']");
				}else{
					fputs($fp,",\$_data['" . $arrayOfProperties[$x] . "']");
				}
			}
		}
		fputs($fp,");");
		fputs($fp,"\n\t\t\$" . strtolower($objectName) . " ->create( \$" . strtolower($objectName) . ");
		unset(\$" . strtolower($objectName) . "); ");
	fputs($fp,"\n\t\t\$data = \$_data;");
	fputs($fp,"\n\t\t\$this->buildView(\$view,\$data);");
	fputs($fp,"\n\t}");
//	DELETE ----------------------------------------------------------------
	fputs($fp,"\n\tpublic function delete(\$_data) {");
	fputs($fp,"\n\t\t\$view=\$this -> view_dir.\"" . strtolower($objectName) . ".delete.view.php\";");
	fputs($fp,"\n\t\tinclude(\"../models/" . strtolower($objectName) . ".model.php\");
		\$" . strtolower($objectName) . " = new " . strtolower($objectName) . "();
		\$" . strtolower($objectName) . "->set_id(\$_data['id']);
		\$" . strtolower($objectName) . " ->delete( \$" . strtolower($objectName) . ");
		unset(\$" . strtolower($objectName) . ");");
	fputs($fp,"\n\t\t\$data = \$_data;");
	fputs($fp,"\n\t\t\$this->buildView(\$view,\$data);");
	fputs($fp,"\n\t}");
	// PAGINATE
	fputs($fp,"\n\tpublic function paginate(\$_data) {");
	fputs($fp,"\n\t\$view=\$this -> view_dir.\"" . strtolower($objectName) . ".view.php\";");
	fputs($fp,"\n\t\t\$data = \$_data;");
	fputs($fp,"\n\t\t\$this->buildView(\$view,\$data);");
	fputs($fp,"\n\t}");
	
//	BUILD VIEW ----------------------------------------------------------------
	fputs($fp,"\n\tpublic function buildView(\$view='',\$data='') { ");
	fputs($fp,"\n\t\tbuild_view(\$view,\$data);");
	fputs($fp,"\n\t}");
	fputs($fp,"\n}");
	fputs($fp,"\n?>\n");
	
	
//   NAVIGATION ----------------------------------------
$controller_name =  strtolower($objectName) . "_controller";
$controller_display = strtolower($objectName) ;
$menu_item = "<li id=\"".$controller_name."\"  class=\" menu_item \" ><a href=\"<?=BASE_URL;?>index.php?c=".$controller_name."&m=read\">".$controller_display."</a></li>";

// ---- end the code writing here   --------------------------------------------------------
require_once('controller_installer.php');
fclose($fp);
echo('<h3>PHP CONTROLLER</h3>');
showCode($controller_final_filepath);
 
?>

