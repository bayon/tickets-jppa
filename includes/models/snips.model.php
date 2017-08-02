<?php 
include_once('mySQLi.model.php');

class snips extends Model  { 

	private $id;
	private $name;
	private $description;
	private $code;
	private $language;
	private $created;
	private $modified;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$name,$description,$code,$language,$created,$modified){
		$this -> id = $id;
		$this -> name = $name;
		$this -> description = $description;
		$this -> code = $code;
		$this -> language = $language;
		$this -> created = $created;
		$this -> modified = $modified;
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
	public function set_code($code){
		$this -> code = $code;
	}
	public function get_code(){
		return $this -> code; 
	}
	public function set_language($language){
		$this -> language = $language;
	}
	public function get_language(){
		return $this -> language; 
	}
	public function set_created($created){
		$this -> created = $created;
	}
	public function get_created(){
		return $this -> created; 
	}
	public function set_modified($modified){
		$this -> modified = $modified;
	}
	public function get_modified(){
		return $this -> modified; 
	}

//---USE CASE (instantiate via POST array)---------------
//$snips = new snips( $_POST['id'], $_POST['name'], $_POST['description'], $_POST['code'], $_POST['language'], $_POST['created'], $_POST['modified']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".snips ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".snips WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------

	 
	function create($snips,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".snips (id,name,description,code,language,created,modified)
		VALUES('".$snips->get_id()."' , '".$snips->get_name()."' , '".$snips->get_description()."' , '".$snips->get_code()."' , '".$snips->get_language()."' , '".global_timestamp()."' , '".global_timestamp()."' );"; 
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($data);
	 
	 } 
	 function update($snips,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".snips set id = '".$snips->get_id()."' , name = '".$snips->get_name()."' , description = '".$snips->get_description()."' , code = '".$snips->get_code()."' , language = '".$snips->get_language()."' , created = '".$snips->get_created()."' , modified = '".global_timestamp()."'  WHERE id = ".$snips->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 
	function delete($snips,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".snips WHERE id = " . $snips -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_snips(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `snips` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `name`  tinytext NOT NULL, `description`  tinytext NOT NULL, `code`  tinytext NOT NULL, `language`  tinytext NOT NULL, `created`  tinytext NOT NULL, `modified`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

