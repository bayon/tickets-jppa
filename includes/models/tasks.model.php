<?php 
include_once('mySQLi.model.php');

class tasks extends Model  { 

	private $id;
	private $parent_id;
	private $name;
	private $owner;
	private $priority;
	private $description;
	private $location;
	private $files;
	private $est_hours;
	private $percent_complete;
	private $est_dt;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$parent_id,$name,$owner,$priority,$description,$location,$files,$est_hours,$percent_complete,$est_dt){
		$this -> id = $id;
		$this -> parent_id = $parent_id;
		$this -> name = $name;
		$this -> owner = $owner;
		$this -> priority = $priority;
		$this -> description = $description;
		$this -> location = $location;
		$this -> files = $files;
		$this -> est_hours = $est_hours;
		$this -> percent_complete = $percent_complete;
		$this -> est_dt = $est_dt;
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
	public function set_owner($owner){
		$this -> owner = $owner;
	}
	public function get_owner(){
		return $this -> owner; 
	}
	public function set_priority($priority){
		$this -> priority = $priority;
	}
	public function get_priority(){
		return $this -> priority; 
	}
	public function set_description($description){
		$this -> description = $description;
	}
	public function get_description(){
		return $this -> description; 
	}
	public function set_location($location){
		$this -> location = $location;
	}
	public function get_location(){
		return $this -> location; 
	}
	public function set_files($files){
		$this -> files = $files;
	}
	public function get_files(){
		return $this -> files; 
	}
	public function set_est_hours($est_hours){
		$this -> est_hours = $est_hours;
	}
	public function get_est_hours(){
		return $this -> est_hours; 
	}
	public function set_percent_complete($percent_complete){
		$this -> percent_complete = $percent_complete;
	}
	public function get_percent_complete(){
		return $this -> percent_complete; 
	}
	public function set_est_dt($est_dt){
		$this -> est_dt = $est_dt;
	}
	public function get_est_dt(){
		return $this -> est_dt; 
	}

//---USE CASE (instantiate via POST array)---------------
//$tasks = new tasks( $_POST['id'], $_POST['parent_id'], $_POST['name'], $_POST['owner'], $_POST['priority'], $_POST['description'], $_POST['location'], $_POST['files'], $_POST['est_hours'], $_POST['percent_complete'], $_POST['est_dt']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".tasks ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".tasks WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	public function read_parent_id($id = "",$return = "") {
        $con = $this -> model_connect();
        $sql = " SELECT * FROM " . $this -> getDatabase() . ".subtasks WHERE parent_id='$id';";
        
        $data = $this -> exe_sql($con, $sql, $return);
        return $data;
    
	} 
public function readByParentId($id='',$return='') { 
	 $con = $this -> model_connect();    
	  $sql = " SELECT * FROM " . $this -> getDatabase() . ".tasks WHERE parent_id='$id';";  
	     $data = $this -> exe_sql($con, $sql, $return);  
	  return $data;  
 }public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------

	 
	function create($tasks,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".tasks (id,parent_id,name,owner,priority,description,location,files,est_hours,percent_complete,est_dt)
		VALUES('".$tasks->get_id()."' , '".$tasks->get_parent_id()."' , '".$tasks->get_name()."' , '".$tasks->get_owner()."' , '".$tasks->get_priority()."' , '".$tasks->get_description()."' , '".$tasks->get_location()."' , '".$tasks->get_files()."' , '".$tasks->get_est_hours()."' , '".$tasks->get_percent_complete()."' , '".$tasks->get_est_dt()."' );"; 
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($data);
	 
	 } 
	 function update($tasks,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".tasks set id = '".$tasks->get_id()."' , parent_id = '".$tasks->get_parent_id()."' , name = '".$tasks->get_name()."' , owner = '".$tasks->get_owner()."' , priority = '".$tasks->get_priority()."' , description = '".$tasks->get_description()."' , location = '".$tasks->get_location()."' , files = '".$tasks->get_files()."' , est_hours = '".$tasks->get_est_hours()."' , percent_complete = '".$tasks->get_percent_complete()."' , est_dt = '".$tasks->get_est_dt()."'  WHERE id = ".$tasks->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 
	function delete($tasks,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".tasks WHERE id = " . $tasks -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_tasks(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `tasks` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `parent_id`  tinytext NOT NULL, `name`  tinytext NOT NULL, `owner`  tinytext NOT NULL, `priority`  tinytext NOT NULL, `description`  tinytext NOT NULL, `location`  tinytext NOT NULL, `files`  tinytext NOT NULL, `est_hours`  tinytext NOT NULL, `percent_complete`  tinytext NOT NULL, `est_dt`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

