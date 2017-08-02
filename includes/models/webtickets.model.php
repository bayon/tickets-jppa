<?php 
include_once('mySQLi.model.php');

class webtickets extends Model  { 

	private $id;
	private $parent_id;
	private $name;
	private $date;
	private $phase1;
	private $phase2;
	private $phase3;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$parent_id,$name,$date,$phase1,$phase2,$phase3){
		$this -> id = $id;
		$this -> parent_id = $parent_id;
		$this -> name = $name;
		$this -> date = $date;
		$this -> phase1 = $phase1;
		$this -> phase2 = $phase2;
		$this -> phase3 = $phase3;
	} 
	public function set_id($id){
		$this -> id = $id;
	}
	public function get_id(){
		return $this -> id; 
	}
	public function set_parent_id($parent_id){
		$this -> parent_id = $parent_id;
	}
	public function get_parent_id(){
		return $this -> parent_id; 
	}
	public function set_name($name){
		$this -> name = $name;
	}
	public function get_name(){
		return $this -> name; 
	}
	public function set_date($date){
		$this -> date = $date;
	}
	public function get_date(){
		return $this -> date; 
	}
	public function set_phase1($phase1){
		$this -> phase1 = $phase1;
	}
	public function get_phase1(){
		return $this -> phase1; 
	}
	public function set_phase2($phase2){
		$this -> phase2 = $phase2;
	}
	public function get_phase2(){
		return $this -> phase2; 
	}
	public function set_phase3($phase3){
		$this -> phase3 = $phase3;
	}
	public function get_phase3(){
		return $this -> phase3; 
	}

//---USE CASE (instantiate via POST array)---------------
//$webtickets = new webtickets( $_POST['id'], $_POST['parent_id'], $_POST['name'], $_POST['date'], $_POST['phase1'], $_POST['phase2'], $_POST['phase3']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".webtickets ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".webtickets WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	public function read_parent_id($id = "",$return = "") {
        $con = $this -> model_connect();
        $sql = " SELECT * FROM " . $this -> getDatabase() . ".xxx WHERE parent_id='$id';";
        
        $data = $this -> exe_sql($con, $sql, $return);
        return $data;
    
	} 
public function readByParentId($id='',$return='') { 
	 $con = $this -> model_connect();    
	  $sql = " SELECT * FROM " . $this -> getDatabase() . ".webtickets WHERE parent_id='$id';";  
	     $data = $this -> exe_sql($con, $sql, $return);  
	  return $data;  
 }public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------

	 
	function create($webtickets,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".webtickets (id,parent_id,name,date,phase1,phase2,phase3)
		VALUES('".$webtickets->get_id()."' , '".$webtickets->get_parent_id()."' , '".$webtickets->get_name()."' , '".global_timestamp()."' , '".$webtickets->get_phase1()."' , '".$webtickets->get_phase2()."' , '".$webtickets->get_phase3()."' );"; 
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($data);
	 
	 } 
	 function update($webtickets,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".webtickets set id = '".$webtickets->get_id()."' , parent_id = '".$webtickets->get_parent_id()."' , name = '".$webtickets->get_name()."' , date = '".global_timestamp()."' , phase1 = '".$webtickets->get_phase1()."' , phase2 = '".$webtickets->get_phase2()."' , phase3 = '".$webtickets->get_phase3()."'  WHERE id = ".$webtickets->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 
	function delete($webtickets,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".webtickets WHERE id = " . $webtickets -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_webtickets(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `webtickets` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `parent_id`  tinytext NOT NULL, `name`  tinytext NOT NULL, `date`  tinytext NOT NULL, `phase1`  tinytext NOT NULL, `phase2`  tinytext NOT NULL, `phase3`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

