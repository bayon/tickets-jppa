<?php
include_once('mySQLi.model.php');

class admin extends Model  {

	private $id;
	private $name;
	private $app_id;
	private $username;
	private $password;
	private $settings_id;
	private $acct_id;
	private $dt_created;
	private $dt_modified;
	private $parent_id;

	function __construct(){
		parent::__construct();
	}
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$name,$app_id,$username,$password,$settings_id,$acct_id,$dt_created,$dt_modified,$parent_id){
		$this -> id = $id;
		$this -> name = $name;
		$this -> app_id = $app_id;
		$this -> username = $username;
		$this -> password = $password;
		$this -> settings_id = $settings_id;
		$this -> acct_id = $acct_id;
		$this -> dt_created = $dt_created;
		$this -> dt_modified = $dt_modified;
		$this -> parent_id = $parent_id;
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
	public function set_app_id($app_id){
		$this -> app_id = $app_id;
	}
	public function get_app_id(){
		return $this -> app_id;
	}
	public function set_username($username){
		$this -> username = $username;
	}
	public function get_username(){
		return $this -> username;
	}
	public function set_password($password){
		$this -> password = $password;
	}
	public function get_password(){
		return $this -> password;
	}
	public function set_settings_id($settings_id){
		$this -> settings_id = $settings_id;
	}
	public function get_settings_id(){
		return $this -> settings_id;
	}
	public function set_acct_id($acct_id){
		$this -> acct_id = $acct_id;
	}
	public function get_acct_id(){
		return $this -> acct_id;
	}
	public function set_dt_created($dt_created){
		$this -> dt_created = $dt_created;
	}
	public function get_dt_created(){
		return $this -> dt_created;
	}
	public function set_dt_modified($dt_modified){
		$this -> dt_modified = $dt_modified;
	}
	public function get_dt_modified(){
		return $this -> dt_modified;
	}
	public function set_parent_id($parent_id){
		$this -> parent_id = $parent_id;
	}
	public function get_parent_id(){
		return $this -> parent_id;
	}

//---USE CASE (instantiate via POST array)---------------
//$admin = new admin( $_POST['id'], $_POST['name'], $_POST['app_id'], $_POST['username'], $_POST['password'], $_POST['settings_id'], $_POST['acct_id'], $_POST['dt_created'], $_POST['dt_modified'], $_POST['parent_id']);

public function verify($username, $password,$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".admin WHERE username = '".$username."'  AND password = '".$password."';";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	}

	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".admin ;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	}

	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".admin WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	} public function read_ModelKV($model='',$k = '',$v='',$return = '') {
  		$con = $this -> model_connect();
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';
   		$data = $this -> exe_sql($con, $sql, $return);
   		return $data;
    	}

//---SQL INSERT -------------------------------


	function create($admin,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".admin (id,name,app_id,username,password,settings_id,acct_id,dt_created,dt_modified,parent_id)
		VALUES(null, '".$admin->get_name()."' , '".$admin->get_app_id()."' , '".$admin->get_username()."' , '".$admin->get_password()."' , '".$admin->get_settings_id()."' , '".$admin->get_acct_id()."' , '".global_timestamp()."' , '".$admin->get_dt_modified()."' , '".$admin->get_parent_id()."' );";
	$data = $this -> exe_sql($con,$sql, $return);
		 // in the case of an insert , the return $data will be the "last id inserted".
    //  mkdir(BASE_PATH."/includes/docs/"."docs_".$data);
		global_mkdir($data);
		echo($data);

	 }
	 function update($admin,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".admin set id = '".$admin->get_id()."' , name = '".$admin->get_name()."' , app_id = '".$admin->get_app_id()."' , username = '".$admin->get_username()."' , password = '".$admin->get_password()."' , settings_id = '".$admin->get_settings_id()."' , acct_id = '".$admin->get_acct_id()."' , dt_created = '".$admin->get_dt_created()."' , dt_modified = '".global_timestamp()."' , parent_id = '".$admin->get_parent_id()."'  WHERE id = ".$admin->get_id()."";
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}

	function delete($admin,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".admin WHERE id = " . $admin -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_admin(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `admin` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `name`  varchar(20) NOT NULL, `app_id`  varchar(20) NOT NULL, `username`  varchar(20) NOT NULL, `password`  varchar(20) NOT NULL, `settings_id`  varchar(20) NOT NULL, `acct_id`  varchar(20) NOT NULL, `dt_created`  varchar(20) NOT NULL, `dt_modified`  varchar(20) NOT NULL, `parent_id`  varchar(20) NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>
