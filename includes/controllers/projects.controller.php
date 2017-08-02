<?php
	//CONTROLLER TEMPLATE
	
class projects_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'projects.view.php';
		$this -> view_dir = 'projects/';
	}
	public function home($_data) {
		$view=$this -> view_dir."projects.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		 $_SESSION['parent_id'] = $_SESSION['admin_id']; 
		$view=$this -> view_dir."projects.view.php";
		 
 		 $projects = new projects();
 
		$data = $projects-> read();
		
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $projects = new projects();
 
		$data = $projects-> read('json');
		 echo($data);
	}



	public function readToJSONByParentId($_data) {
		
		 
 		 $projects = new projects();
		$data = $projects-> readByParentId($_SESSION['parent_id'],'json');
		 echo($data);
		 

	}
	public function drill_down($_data) {
		 
 		$projects = new projects();
		$data_projects = $projects-> readByParentId($_SESSION['parent_id'],'');

 		 $proj_prct = null;
		//echo(count($data_projects)); 
		//echo('REQUIREMENTS');
		for($z = 0;$z < count($data_projects); $z++){
			//echo('PROJECT:'.$z."-".$data_projects[$z]['name']);
 				$requirements = new requirements();
				$data_requirements = $requirements-> readByParentId($data_projects[$z]['id'],'');
 				$req_sum = 0;
				$req_prct = null;
				for($y = 0; $y <count($data_requirements); $y++){
					//echo('Requirement:'.$y."-".$data_requirements[$y]['name']);
					$tasks = new tasks();
					$data_tasks = $tasks-> readByParentId($data_requirements[$y]['id'],'');
					$req_sum = $req_sum + $data_requirements[$y]['percent_complete'];
 					$task_sum = 0;
					$task_prct =null;
					 for($x = 0; $x < count($data_tasks); $x++){
					 		//echo('TASK:'.$x);
					 		$task_sum = $task_sum + $data_tasks[$x]['percent_complete'];
					 	 
							$task_prct =$task_sum/(count($data_tasks));

					 }
 					
 					$req_prct = round($req_sum/(count($data_requirements)),2);
 				}
 

				$proj_prct =round( $proj_sum/(count($data_projects)) ,2);
				//echo('P%'.$req_prct);
		//echo('-------------||');
		$data_projects[$z]['percent_complete'] = $req_prct;
		}
		
		echo(json_encode($data_projects));

 


	}


	public function read_id($_data) {
	header('LOCATION: ?c=projects_controller&m=paginate&where=where id='.$_data);
	}	public function read_parent_id($_data) {
			$view=$this -> view_dir."projects.view.php"; $_SESSION['parent_id'] = $_data['parent_id']; $data = $_data; 	$this->buildView($view,$data);
	}
	public function edit($_data) {

		include_once("../models/projects.model.php");
		$projects = new projects(); 
		$projects->init($_data['id'],$_SESSION['parent_id'],$_data['name'],$_data['owner'],$_data['brand'],$_data['priority'],$_data['description'],$_data['location'],$_data['mockup'],$_data['est_hours'],$_data['percent_complete'],$_data['desired_dt'],$_data['est_dt']);
			$projects->set_id($_data['id']);
		$projects ->update($projects);
		unset($projects);
		$view=$this -> view_dir."projects.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."projects.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/projects.model.php");
		$projects = new Projects(); 
		$projects->init($_data['id'],$_SESSION['parent_id'],$_data['name'],$_data['owner'],$_data['brand'],$_data['priority'],$_data['description'],$_data['location'],$_data['mockup'],$_data['est_hours'],$_data['percent_complete'],$_data['desired_dt'],$_data['est_dt']);
		$projects ->create( $projects);
		unset($projects); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."projects.delete.view.php";
		include("../models/projects.model.php");
		$projects = new projects();
		$projects->set_id($_data['id']);
		$projects ->delete( $projects);
		unset($projects);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."projects.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}


	///////////////////////////////////
	public function readToJSONByParentId_ALL($_data) {
		
 		$projects = new projects();
		$data = $projects-> readByParentId($_SESSION['parent_id']);
		$final_data = [];
		//print_r($data);
		
		for($i = 0; $i <= count($data); $i++){
			 $data_1 = [];
			 array_push($data_1,$data[$i]);
			$parent_id = $data[$i]['id'];
			$requirements = new requirements();
			$req_data = $requirements-> readByParentId($parent_id);
			 array_push($data_1,$req_data);
			for($j=0; $j<= count($req_data); $j++){
				$parent_id_2 = $req_data[$j]['id'];
				//echo($parent_id_2);
				$tasks = new tasks();
				$task_data =  $tasks-> readByParentId($parent_id_2);
				// index 1 becasue requirements always at level 1
 				array_push($data_1[1][$j],$task_data);
			}
			//print_r($data_1);
			//echo(json_encode($data_1));
			array_push($final_data,$data_1);
		}

		echo(json_encode($final_data));
		//print_r($_data);
		//die();
		 
	}

	public function excelUp(){

		  
		/*******EDIT LINES 3-8*******/
		$DB_Server = "localhost"; //MySQL Server    
		$DB_Username = "root"; //MySQL Username     
		$DB_Password = "";             //MySQL Password     
		$DB_DBName = "tickets";         //MySQL Database Name  
		$DB_TBLName = "projects"; //MySQL Table Name   
		$filename = BASE_PATH."/includes/controllers/projects";         //File Name
		/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
		//create MySQL connection   
		$sql = "Select * from $DB_TBLName";
		$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
		//select database   
		$Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
		//execute query 
		$result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
		$file_ending = "xls";
		//header info for browser
		header("Content-Type: application/xls");    
		header("Content-Disposition: attachment; filename=$filename.xls");  
		header("Pragma: no-cache"); 
		header("Expires: 0");
		/*******Start of Formatting for Excel*******/   
		//define separator (defines columns in excel & tabs in word)
		$sep = "\t"; //tabbed character
		//start of printing column names as names of MySQL fields
		for ($i = 0; $i < mysql_num_fields($result); $i++) {
		echo mysql_field_name($result,$i) . "\t";
		}
		print("\n");    
		//end of printing column names  
		//start while loop to get data
		    while($row = mysql_fetch_row($result))
		    {
		        $schema_insert = "";
		        for($j=0; $j<mysql_num_fields($result);$j++)
		        {
		            if(!isset($row[$j]))
		                $schema_insert .= "NULL".$sep;
		            elseif ($row[$j] != "")
		                $schema_insert .= "$row[$j]".$sep;
		            else
		                $schema_insert .= "".$sep;
		        }
		        $schema_insert = str_replace($sep."$", "", $schema_insert);
		        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		        $schema_insert .= "\t";
		        print(trim($schema_insert));
		        print "\n";
		    }   

			}
	////////////////////////////////////
}
?>
