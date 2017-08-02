<?php
include_once('mySQLi.model.php');

class record extends Model  {

	private $id;
	private $name;
	private $parent_id;
	private $doc_id;
	private $title;
	private $description;
	private $updated;

	function __construct(){
		parent::__construct();
	}
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$name,$parent_id,$doc_id,$title,$description,$updated){
		$this -> id = $id;
		$this -> name = $name;
		$this -> parent_id = $parent_id;
		$this -> doc_id = $doc_id;
		$this -> title = $title;
		$this -> description = $description;
		$this -> updated = $updated;
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
	public function set_parent_id($parent_id){
		$this -> parent_id = $parent_id;
	}
	public function get_parent_id(){
		return $this -> parent_id;
	}
	public function set_doc_id($doc_id){
		$this -> doc_id = $doc_id;
	}
	public function get_doc_id(){
		return $this -> doc_id;
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
	public function set_updated($updated){
		$this -> updated = $updated;
	}
	public function get_updated(){
		return $this -> updated;
	}

//---USE CASE (instantiate via POST array)---------------
//$record = new record( $_POST['id'], $_POST['name'], $_POST['parent_id'], $_POST['doc_id'], $_POST['title'], $_POST['description'], $_POST['updated']);


	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".record ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	}

	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".record WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	}
	public function read_parent_id($id = "",$return = "") {
        $con = $this -> model_connect();
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql = " SELECT * FROM " . $this -> getDatabase() . ".record WHERE doc_id='$id';";
        ///////////////////////////////////////////////////////////////////////////////////////////
        $data = $this -> exe_sql($con, $sql, $return);
        //return $sql;
        return $data;
    }

	public function read_ModelKV($model='',$k = '',$v='',$return = '') {
  		$con = $this -> model_connect();
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';
   		$data = $this -> exe_sql($con, $sql, $return);
   		return $data;
    	}

//---SQL INSERT -------------------------------


	function create($record,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".record (id,name,parent_id,doc_id,title,description,updated)
		VALUES(null, '".$record->get_name()."' , '".$_SESSION['admin_id']."' , '".$_SESSION['doc_id']."' , '".$record->get_title()."' , '".$record->get_description()."' , '".global_timestamp()."' );";
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($data);

	 }
	 function update($record,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".record set id = '".$record->get_id()."' , name = '".$record->get_name()."' , parent_id = '".$_SESSION['admin_id']."' , doc_id = '".$_SESSION['doc_id']."' , title = '".$record->get_title()."' , description = '".$record->get_description()."' , updated = '".global_timestamp()."'  WHERE id = ".$record->get_id()."";
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}

	function delete($record,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".record WHERE id = " . $record -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_record(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `record` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `name`  tinytext NOT NULL, `parent_id`  tinytext NOT NULL, `doc_id`  tinytext NOT NULL, `title`  tinytext NOT NULL, `description`  tinytext NOT NULL, `updated`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>
