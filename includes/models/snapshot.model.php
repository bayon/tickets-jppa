<?php 
include_once('mySQLi.model.php');

class snapshot extends Model  { 

	private $id;
	private $name;
	private $description;
	private $created_dt;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$name,$description,$created_dt){
		$this -> id = $id;
		$this -> name = $name;
		$this -> description = $description;
		$this -> created_dt = $created_dt;
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
	public function set_created_dt($created_dt){
		$this -> created_dt = $created_dt;
	}
	public function get_created_dt(){
		return $this -> created_dt; 
	}

//---USE CASE (instantiate via POST array)---------------
//$snapshot = new snapshot( $_POST['id'], $_POST['name'], $_POST['description'], $_POST['created_dt']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".snapshot ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".snapshot WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------

	 
	function create($snapshot,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".snapshot (id,name,description,created_dt)
		VALUES('".$snapshot->get_id()."' , '".$snapshot->get_name()."' , '".$snapshot->get_description()."' , '".global_timestamp()."' );"; 
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($sql);
		//echo($data);
	 
	 } 
	 function update($snapshot,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".snapshot set id = '".$snapshot->get_id()."' , name = '".$snapshot->get_name()."' , description = '".$snapshot->get_description()."' , created_dt = '".$snapshot->get_created_dt()."'  WHERE id = ".$snapshot->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 
	function delete($snapshot,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".snapshot WHERE id = " . $snapshot -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_snapshot(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `snapshot` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `name`  tinytext NOT NULL, `description`  tinytext NOT NULL, `created_dt`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

