<?php 
include_once('mySQLi.model.php');

class todo extends Model  { 

	private $id;
	private $name;
	private $description;
	private $notes;
	private $completed;
	//private $percent;
	//private $due;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$name,$description,$notes,$completed,$percent,$due){
		$this -> id = $id;
		$this -> name = $name;
		$this -> description = $description;
		$this -> notes = $notes;
		$this -> completed = $completed;
		$this -> percent = $percent;
		$this -> due = $due;
	} 
	public function set_id($id){
		$this -> id = $id;
	}
	public function get_id(){
		return $this -> id; 
	}
	public function set_name($name){
		$this -> name = $name;
	}
	public function get_name(){
		return $this -> name; 
	}
	public function set_description($description){
		$this -> description = $description;
	}
	public function get_description(){
		return $this -> description; 
	}
	public function set_notes($notes){
		$this -> notes = $notes;
	}
	public function get_notes(){
		return $this -> notes; 
	}
	public function set_completed($completed){
		$this -> completed = $completed;
	}
	public function get_completed(){
		return $this -> completed; 
	}
	
	public function set_percent($percent){
		$this -> percent = $percent;
	}
	public function get_percent(){
		return $this -> percent; 
	}
	public function set_due($due){
		$this -> due = $due;
	}
	public function get_due(){
		return $this -> due; 
	}

	

//---USE CASE (instantiate via POST array)---------------
//$todo = new todo( $_POST['id'], $_POST['name'], $_POST['description'], $_POST['notes'], $_POST['completed']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".todo ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".todo WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------
// CHANGE '".$todo->get_id()."'   to       null  
	 /*
	function create($todo,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".todo (id,name,description,notes,completed)
		VALUES(null , '".$todo->get_name()."' , '".$todo->get_description()."' , '".$todo->get_notes()."' , '".$todo->get_completed()."' );"; 
		$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
	 
		return $data;
	 
	 } 
	 function update($todo,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".todo set id = '".$todo->get_id()."' , name = '".$todo->get_name()."' , description = '".$todo->get_description()."' , notes = '".$todo->get_notes()."' , completed = '".global_timestamp()."'  WHERE id = ".$todo->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 */
	//new version for percent and due:
	function create($todo,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".todo (id,name,description,notes,completed,percent,due)
		VALUES(null , '".$todo->get_name()."' , '".$todo->get_description()."' , '".$todo->get_notes()."' , '".$todo->get_completed()."', '".$todo->get_percent()."', '".$todo->get_due()."' );"; 
		$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
	 
		return $data;
	 
	 } 
	 function update($todo,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".todo set id = '".$todo->get_id()."' , name = '".$todo->get_name()."' , description = '".$todo->get_description()."' , notes = '".$todo->get_notes()."' , completed = '".global_timestamp()."' , percent = '".$todo->get_percent()."', due = '".$todo->get_due()."'  WHERE id = ".$todo->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}

	 
	function delete($todo,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".todo WHERE id = " . $todo -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_todo(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `todo` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `name`  varchar(20) NOT NULL, `description`  varchar(20) NOT NULL, `notes`  varchar(20) NOT NULL, `completed`  varchar(20) NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

