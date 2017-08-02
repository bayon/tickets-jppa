<?php
	//CONTROLLER TEMPLATE
	
class requirements_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'requirements.view.php';
		$this -> view_dir = 'requirements/';
	}
	public function home($_data) {
		$view=$this -> view_dir."requirements.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		// TOP PARENT ONLY: $_SESSION['parent_id'] = $_SESSION['admin_id']; 
		 //persist parent id:

		$view=$this -> view_dir."requirements.view.php";
		 
 		 $requirements = new requirements();
 
		$data = $requirements-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $requirements = new requirements();
 
		$data = $requirements-> read('json');
		 echo($data);
	}
	public function readToJSONByParentId($_data) {
		 
 		 $requirements = new requirements();
 
		$data = $requirements-> readByParentId($_SESSION['parent_id'],'json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=requirements_controller&m=paginate&where=where id='.$_data);
	}	
	public function read_parent_id($_data) {
			$view=$this -> view_dir."requirements.view.php"; 
			$_SESSION['parent_id'] = $_data['parent_id']; 
			$_SESSION['parent_name'] = $_data['parent_name']; 
			$data = $_data; 	
			$this->buildView($view,$data);
	}
	public function edit($_data) {

		include_once("../models/requirements.model.php");
		$requirements = new requirements(); 
		$requirements->init($_data['id'],$_data['parent_id'],$_data['name'],$_data['owner'],$_data['priority'],$_data['description'],$_data['location'],$_data['files'],$_data['mockup'],$_data['dependencies'],$_data['est_hours'],$_data['percent_complete'],$_data['est_dt']);
			$requirements->set_id($_data['id']);
		$requirements ->update($requirements);
		unset($requirements);
		//persist parent id:
		 

		$view=$this -> view_dir."requirements.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."requirements.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/requirements.model.php");
		$requirements = new Requirements(); 
		$requirements->init($_data['id'],$_SESSION['parent_id'],$_data['name'],$_data['owner'],$_data['priority'],$_data['description'],$_data['location'],$_data['files'],$_data['mockup'],$_data['dependencies'],$_data['est_hours'],$_data['percent_complete'],$_data['est_dt']);
		$requirements ->create( $requirements);
		unset($requirements); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."requirements.delete.view.php";
		include("../models/requirements.model.php");
		$requirements = new requirements();
		$requirements->set_id($_data['id']);
		$requirements ->delete( $requirements);
		unset($requirements);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."requirements.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
