<?php 
include_once('mySQLi.model.php');

class projects extends Model  { 

	private $id;
	private $parent_id;
	private $name;
	private $owner;
	private $brand;
	private $priority;
	private $description;
	private $location;
	private $mockup;
	private $est_hours;
	private $percent_complete;
	private $desired_dt;
	private $est_dt;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$parent_id,$name,$owner,$brand,$priority,$description,$location,$mockup,$est_hours,$percent_complete,$desired_dt,$est_dt){
		$this -> id = $id;
		$this -> parent_id = $parent_id;
		$this -> name = $name;
		$this -> owner = $owner;
		$this -> brand = $brand;
		$this -> priority = $priority;
		$this -> description = $description;
		$this -> location = $location;
		$this -> mockup = $mockup;
		$this -> est_hours = $est_hours;
		$this -> percent_complete = $percent_complete;
		$this -> desired_dt = $desired_dt;
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
	public function set_brand($brand){
		$this -> brand = $brand;
	}
	public function get_brand(){
		return $this -> brand; 
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
	public function set_mockup($mockup){
		$this -> mockup = $mockup;
	}
	public function get_mockup(){
		return $this -> mockup; 
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
	public function set_desired_dt($desired_dt){
		$this -> desired_dt = $desired_dt;
	}
	public function get_desired_dt(){
		return $this -> desired_dt; 
	}
	public function set_est_dt($est_dt){
		$this -> est_dt = $est_dt;
	}
	public function get_est_dt(){
		return $this -> est_dt; 
	}

//---USE CASE (instantiate via POST array)---------------
//$projects = new projects( $_POST['id'], $_POST['parent_id'], $_POST['name'], $_POST['owner'], $_POST['brand'], $_POST['priority'], $_POST['description'], $_POST['location'], $_POST['mockup'], $_POST['est_hours'], $_POST['percent_complete'], $_POST['desired_dt'], $_POST['est_dt']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".projects ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".projects WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	public function read_parent_id($id = "",$return = "") {
        $con = $this -> model_connect();
        $sql = " SELECT * FROM " . $this -> getDatabase() . ".requirements WHERE parent_id='$id';";
        
        $data = $this -> exe_sql($con, $sql, $return);
        return $data;
    
	} 
public function readByParentId($id='',$return='') { 
	 $con = $this -> model_connect();    
	  $sql = " SELECT * FROM " . $this -> getDatabase() . ".projects WHERE parent_id='$id';";  
	     $data = $this -> exe_sql($con, $sql, $return);  
	  return $data;  
 }
 



 public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------

	 
	function create($projects,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".projects (id,parent_id,name,owner,brand,priority,description,location,mockup,est_hours,percent_complete,desired_dt,est_dt)
		VALUES('".$projects->get_id()."' , '".$projects->get_parent_id()."' , '".$projects->get_name()."' , '".$projects->get_owner()."' , '".$projects->get_brand()."' , '".$projects->get_priority()."' , '".$projects->get_description()."' , '".$projects->get_location()."' , '".$projects->get_mockup()."' , '".$projects->get_est_hours()."' , '".$projects->get_percent_complete()."' , '".$projects->get_desired_dt()."' , '".$projects->get_est_dt()."' );"; 
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($data);
	 
	 } 
	 function update($projects,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".projects set id = '".$projects->get_id()."' , parent_id = '".$projects->get_parent_id()."' , name = '".$projects->get_name()."' , owner = '".$projects->get_owner()."' , brand = '".$projects->get_brand()."' , priority = '".$projects->get_priority()."' , description = '".$projects->get_description()."' , location = '".$projects->get_location()."' , mockup = '".$projects->get_mockup()."' , est_hours = '".$projects->get_est_hours()."' , percent_complete = '".$projects->get_percent_complete()."' , desired_dt = '".$projects->get_desired_dt()."' , est_dt = '".$projects->get_est_dt()."'  WHERE id = ".$projects->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 
	function delete($projects,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".projects WHERE id = " . $projects -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_projects(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `projects` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `parent_id`  tinytext NOT NULL, `name`  tinytext NOT NULL, `owner`  tinytext NOT NULL, `brand`  tinytext NOT NULL, `priority`  tinytext NOT NULL, `description`  tinytext NOT NULL, `location`  tinytext NOT NULL, `mockup`  tinytext NOT NULL, `est_hours`  tinytext NOT NULL, `percent_complete`  tinytext NOT NULL, `desired_dt`  tinytext NOT NULL, `est_dt`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

