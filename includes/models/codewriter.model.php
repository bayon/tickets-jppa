<?php 
include_once('mySQLi.model.php');

class codewriter extends Model  { 

	private $id;
	private $modelname;
	private $modelsql;
	 

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$modelname,$modelsql){
		$this -> id = $id;
		$this -> modelname = $modelname;
		$this -> modelsql = $modelsql;
		 
	} 
	public function set_id($id){
		$this -> id = $id;
	}
	public function get_id(){
		return $this -> id; 
	}
	public function set_modelname($modelname){
		$this -> modelname = $modelname;
	}
	public function get_modelname(){
		return $this -> modelname; 
	}
	 
	public function set_modelsql($modelsql){
		$this -> modelsql = $modelsql;
	}
	public function get_modelsql(){
		return $this -> modelsql; 
	}
	 
	 
	public function writeTable($sql,$return="") {
		$con = $this -> model_connect();
		$data = $this -> exe_sql($con, $sql, $return);
		return $sql;
	} 
	  

}
?>

