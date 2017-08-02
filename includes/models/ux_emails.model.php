<?php 
include_once('mySQLi.model.php');

class ux_emails extends Model  { 

	private $id;
	private $name;
	private $description;
	private $assigned;
	private $created;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$name,$description,$assigned,$created){
		$this -> id = $id;
		$this -> name = $name;
		$this -> description = $description;
		$this -> assigned = $assigned;
		$this -> created = $created;
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
	public function set_assigned($assigned){
		$this -> assigned = $assigned;
	}
	public function get_assigned(){
		return $this -> assigned; 
	}
	public function set_created($created){
		$this -> created = $created;
	}
	public function get_created(){
		return $this -> created; 
	}

//---USE CASE (instantiate via POST array)---------------
//$ux_emails = new ux_emails( $_POST['id'], $_POST['name'], $_POST['description'], $_POST['assigned'], $_POST['created']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".ux_emails ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".ux_emails WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------

	 
	function create($ux_emails,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".ux_emails (id,name,description,assigned,created)
		VALUES('".$ux_emails->get_id()."' , '".$ux_emails->get_name()."' , '".$ux_emails->get_description()."' , '".$ux_emails->get_assigned()."' , '".$ux_emails->get_created()."' );"; 
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($data);
	 
	 } 
	 function update($ux_emails,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".ux_emails set id = '".$ux_emails->get_id()."' , name = '".$ux_emails->get_name()."' , description = '".$ux_emails->get_description()."' , assigned = '".$ux_emails->get_assigned()."' , created = '".$ux_emails->get_created()."'  WHERE id = ".$ux_emails->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 
	function delete($ux_emails,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".ux_emails WHERE id = " . $ux_emails -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_ux_emails(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `ux_emails` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `name`  tinytext NOT NULL, `description`  tinytext NOT NULL, `assigned`  tinytext NOT NULL, `created`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

