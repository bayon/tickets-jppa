<?php 
include_once('mySQLi.model.php');

class prioritize extends Model  { 

	private $id;
	private $name;
	private $description;
	private $business;
	private $impact_benifit;
	private $overall_rank;
	private $mktg_cc_rank;
	private $man_days;
	private $duration;
	private $contact;
	private $priority;
	private $type;
	private $status;
	private $dept;
	private $responsible;
	private $note;

	function __construct(){
		parent::__construct();
	} 
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$name,$description,$business,$impact_benifit,$overall_rank,$mktg_cc_rank,$man_days,$duration,$contact,$priority,$type,$status,$dept,$responsible,$note){
		$this -> id = $id;
		$this -> name = $name;
		$this -> description = $description;
		$this -> business = $business;
		$this -> impact_benifit = $impact_benifit;
		$this -> overall_rank = $overall_rank;
		$this -> mktg_cc_rank = $mktg_cc_rank;
		$this -> man_days = $man_days;
		$this -> duration = $duration;
		$this -> contact = $contact;
		$this -> priority = $priority;
		$this -> type = $type;
		$this -> status = $status;
		$this -> dept = $dept;
		$this -> responsible = $responsible;
		$this -> note = $note;
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
	public function set_business($business){
		$this -> business = $business;
	}
	public function get_business(){
		return $this -> business; 
	}
	public function set_impact_benifit($impact_benifit){
		$this -> impact_benifit = $impact_benifit;
	}
	public function get_impact_benifit(){
		return $this -> impact_benifit; 
	}
	public function set_overall_rank($overall_rank){
		$this -> overall_rank = $overall_rank;
	}
	public function get_overall_rank(){
		return $this -> overall_rank; 
	}
	public function set_mktg_cc_rank($mktg_cc_rank){
		$this -> mktg_cc_rank = $mktg_cc_rank;
	}
	public function get_mktg_cc_rank(){
		return $this -> mktg_cc_rank; 
	}
	public function set_man_days($man_days){
		$this -> man_days = $man_days;
	}
	public function get_man_days(){
		return $this -> man_days; 
	}
	public function set_duration($duration){
		$this -> duration = $duration;
	}
	public function get_duration(){
		return $this -> duration; 
	}
	public function set_contact($contact){
		$this -> contact = $contact;
	}
	public function get_contact(){
		return $this -> contact; 
	}
	public function set_priority($priority){
		$this -> priority = $priority;
	}
	public function get_priority(){
		return $this -> priority; 
	}
	public function set_type($type){
		$this -> type = $type;
	}
	public function get_type(){
		return $this -> type; 
	}
	public function set_status($status){
		$this -> status = $status;
	}
	public function get_status(){
		return $this -> status; 
	}
	public function set_dept($dept){
		$this -> dept = $dept;
	}
	public function get_dept(){
		return $this -> dept; 
	}
	public function set_responsible($responsible){
		$this -> responsible = $responsible;
	}
	public function get_responsible(){
		return $this -> responsible; 
	}
	public function set_note($note){
		$this -> note = $note;
	}
	public function get_note(){
		return $this -> note; 
	}

//---USE CASE (instantiate via POST array)---------------
//$prioritize = new prioritize( $_POST['id'], $_POST['name'], $_POST['description'], $_POST['business'], $_POST['impact_benifit'], $_POST['overall_rank'], $_POST['mktg_cc_rank'], $_POST['man_days'], $_POST['duration'], $_POST['contact'], $_POST['priority'], $_POST['type'], $_POST['status'], $_POST['dept'], $_POST['responsible'], $_POST['note']); 

	 
	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".prioritize ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} 
	 
	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".prioritize WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;
	 
	} public function read_ModelKV($model='',$k = '',$v='',$return = '') { 
  		$con = $this -> model_connect(); 
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';  
   		$data = $this -> exe_sql($con, $sql, $return);  
   		return $data; 
    	} 
   
//---SQL INSERT -------------------------------

	 
	function create($prioritize,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".prioritize (id,name,description,business,impact_benifit,overall_rank,mktg_cc_rank,man_days,duration,contact,priority,type,status,dept,responsible,note)
		VALUES('".$prioritize->get_id()."' , '".$prioritize->get_name()."' , '".$prioritize->get_description()."' , '".$prioritize->get_business()."' , '".$prioritize->get_impact_benifit()."' , '".$prioritize->get_overall_rank()."' , '".$prioritize->get_mktg_cc_rank()."' , '".$prioritize->get_man_days()."' , '".$prioritize->get_duration()."' , '".$prioritize->get_contact()."' , '".$prioritize->get_priority()."' , '".$prioritize->get_type()."' , '".$prioritize->get_status()."' , '".$prioritize->get_dept()."' , '".$prioritize->get_responsible()."' , '".$prioritize->get_note()."' );"; 
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return data will be the "last id inserted".
		echo($data);
	 
	 } 
	 function update($prioritize,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".prioritize set id = '".$prioritize->get_id()."' , name = '".$prioritize->get_name()."' , description = '".$prioritize->get_description()."' , business = '".$prioritize->get_business()."' , impact_benifit = '".$prioritize->get_impact_benifit()."' , overall_rank = '".$prioritize->get_overall_rank()."' , mktg_cc_rank = '".$prioritize->get_mktg_cc_rank()."' , man_days = '".$prioritize->get_man_days()."' , duration = '".$prioritize->get_duration()."' , contact = '".$prioritize->get_contact()."' , priority = '".$prioritize->get_priority()."' , type = '".$prioritize->get_type()."' , status = '".$prioritize->get_status()."' , dept = '".$prioritize->get_dept()."' , responsible = '".$prioritize->get_responsible()."' , note = '".$prioritize->get_note()."'  WHERE id = ".$prioritize->get_id()."";	
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}
	 
	function delete($prioritize,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".prioritize WHERE id = " . $prioritize -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_prioritize(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `prioritize` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `name`  tinytext NOT NULL, `description`  tinytext NOT NULL, `business`  tinytext NOT NULL, `impact_benifit`  tinytext NOT NULL, `overall_rank`  tinytext NOT NULL, `mktg_cc_rank`  tinytext NOT NULL, `man_days`  tinytext NOT NULL, `duration`  tinytext NOT NULL, `contact`  tinytext NOT NULL, `priority`  tinytext NOT NULL, `type`  tinytext NOT NULL, `status`  tinytext NOT NULL, `dept`  tinytext NOT NULL, `responsible`  tinytext NOT NULL, `note`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>

