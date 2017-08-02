<?php
include_once('mySQLi.model.php');

class publish extends Model  {

	private $id;
	private $name;
	private $admin_id;
	private $doc_id;
	private $published;

	function __construct(){
		parent::__construct();
	}
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$name,$admin_id,$doc_id,$published){
		$this -> id = $id;
		$this -> name = $name;
		$this -> admin_id = $admin_id;
		$this -> doc_id = $doc_id;
		$this -> published = $published;
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
	public function set_admin_id($admin_id){
		$this -> admin_id = $admin_id;
	}
	public function get_admin_id(){
		return $this -> admin_id;
	}
	public function set_doc_id($doc_id){
		$this -> doc_id = $doc_id;
	}
	public function get_doc_id(){
		return $this -> doc_id;
	}
	public function set_published($published){
		$this -> published = $published;
	}
	public function get_published(){
		return $this -> published;
	}

//---USE CASE (instantiate via POST array)---------------
//$publish = new publish( $_POST['id'], $_POST['name'], $_POST['admin_id'], $_POST['doc_id'], $_POST['published']);


	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".publish ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	}

	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".publish WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	} public function read_ModelKV($model='',$k = '',$v='',$return = '') {
  		$con = $this -> model_connect();
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';
   		$data = $this -> exe_sql($con, $sql, $return);
   		return $data;
    	}

//---SQL INSERT -------------------------------

/*
	function create($publish,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".publish (id,name,admin_id,doc_id,published)
		VALUES('".$publish->get_id()."' , '".$publish->get_name()."' , '".$publish->get_admin_id()."' , '".$publish->get_doc_id()."' , '".$publish->get_published()."' );";
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($sql);
		//echo($data);

	 }*/
	 	function create($publish,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".publish (id,name,admin_id,doc_id,published)
		VALUES(null , '".$publish->get_name()."' , '".$_SESSION['admin_id']."' , '".$_SESSION['doc_id']."' , '".global_timestamp()."' );";
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		//echo($sql);
		echo($data);

	 }
	 function update($publish,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".publish set id = '".$publish->get_id()."' , name = '".$publish->get_name()."' , admin_id = '".$publish->get_admin_id()."' , doc_id = '".$publish->get_doc_id()."' , published = '".$publish->get_published()."'  WHERE id = ".$publish->get_id()."";
		$data = $this -> exe_sql($con, $sql, $return);
 		//echo($sql);
 		echo($data);
	}

	function delete($publish,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".publish WHERE id = " . $publish -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_publish(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `publish` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `name`  tinytext NOT NULL, `admin_id`  tinytext NOT NULL, `doc_id`  tinytext NOT NULL, `published`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>
