<?php 
include_once('mySQLi.model.php');

class notes extends Model  { 

	private $id;
	private $title;
	private $description;
	private $created;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$title,$description,$created){
		$this -> id = $id;
		$this -> title = $title;
		$this -> description = $description;
		$this -> created = $created;
	} 
	public function set_id($id){
		$this -> id = $id;
	}
	public function get_id(){
		return $this -> id; 
	}
	public function set_title($title){
		$this -> title = $title;
	}
	public function get_title(){
		return $this -> title; 
	}
	public function set_description($description){
		$this -> description = $description;
	}
	public function get_description(){
		return $this -> description; 
	}
	public function set_created($created){
		$this -> created = $created;
	}
	public function get_created(){
		return $this -> created; 
	}

//---USE CASE (instantiate via POST array)---------------
//$notes = new notes( $_POST['id'], $_POST['title'], $_POST['description'], $_POST['created']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".notes ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".notes WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------

	 
	function create($notes,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".notes (id,title,description,created)
		VALUES('".$notes->get_id()."' , '".$notes->get_title()."' , '".$notes->get_description()."' , '".$notes->get_created()."' );"; 
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($data);
	 
	 } 
	 function update($notes,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".notes set id = '".$notes->get_id()."' , title = '".$notes->get_title()."' , description = '".$notes->get_description()."' , created = '".$notes->get_created()."'  WHERE id = ".$notes->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 
	function delete($notes,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".notes WHERE id = " . $notes -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_notes(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `notes` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `title`  tinytext NOT NULL, `description`  tinytext NOT NULL, `created`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

