<?php
	//CONTROLLER TEMPLATE
	
class admin_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'admin.view.php';
		$this -> view_dir = 'admin/';
	}
	public function home($_data) {
		$view=$this -> view_dir."admin.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."admin.view.php";
		 
 		 $admin = new admin();
 
		$data = $admin-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $admin = new admin();
 
		$data = $admin-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=admin_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/admin.model.php");
		$admin = new admin(); 
		$admin->init($_data['id'],$_data['name'],$_data['app_id'],$_data['username'],$_data['password'],$_data['settings_id'],$_data['acct_id'],$_data['dt_created'],$_data['dt_modified'],$_data['parent_id']);
			$admin->set_id($_data['id']);
		$admin ->update($admin);
		unset($admin);
		$view=$this -> view_dir."admin.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."admin.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/admin.model.php");
		$admin = new Admin(); 
		$admin->init($_data['id'],$_data['name'],$_data['app_id'],$_data['username'],$_data['password'],$_data['settings_id'],$_data['acct_id'],$_data['dt_created'],$_data['dt_modified'],$_data['parent_id']);
		$admin ->create( $admin);
		unset($admin); 
		$data = $_data;
        
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."admin.delete.view.php";
		include("../models/admin.model.php");
		$admin = new admin();
		$admin->set_id($_data['id']);
		$admin ->delete( $admin);
		unset($admin);
		$data = $_data;
		$this->buildView($view,$data);
	}
////////////////////////////////////////////////
	public function signUp() {
		$view_type = 'signUp';
		$view = $this -> view_dir.'admin.signup.view.php';
		$data='';
 		build_view($view,$data,$view_type);
	}
	public function register() {
		$admin = new Admin();
 		$admin->init(NULL,APP_ID,$_POST['username'],$_POST['password']);
		$admin->create_Admin($admin);
		$view_type = 'register';
		$view = $this -> view_dir.'admin.register.view.php';
		$data='';
		build_view($view,$data,$view_type);
	}
	public function login() {
		
		if($_SESSION['authorized'] == 1){
			$view = $this -> view_dir.'admin.main.view.php';
			$data='';
			$_SESSION['authorized'] = 1;
			build_view($view,$data);
		}else{
			$view_type = 'login';
			$view = $this -> view_dir.'admin.login.view.php';
			$data='';
			build_view($view,$data,$view_type);
		}		
		
	}
	 public function logout() {
	 	session_start();
	    session_unset();
	    session_destroy();
	    session_write_close();
	    setcookie(session_name(),'',0,'/');
	    session_regenerate_id(true);		
		//$view_type = 'login';
		//$view = $this -> view_dir.'admin.main.view.php';
		//$view = "main/main.home.view.php";
		//$data='';
		//build_view($view,$data);
		header('LOCATION:index.php');
	}
   
 
	public function verify() {
		$admin = new Admin();
		$result = $admin->verify($_POST['username'],$_POST['password']);
		//print_r($result);die();
		if($result){
			//echo($result);
			$_SESSION['admin_id'] = $result[0]['id'];
 			$view = $this -> view_dir.'admin.main.view.php';
			$data=$result;
			$_SESSION['authorized'] = 1;
			build_view($view,$data);
			
		}else{
			$_SESSION['authorized'] = 0;
 			//$view = $this -> view_dir.'admin.main.view.php';
			//$data='';
			//build_view($view,$data);
			header('LOCATION:index.php');
		}
	} 
	public function paginate($_data) {
	$view=$this -> view_dir."admin.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
