<?php
	//CONTROLLER TEMPLATE
	
class tasks_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'tasks.view.php';
		$this -> view_dir = 'tasks/';
	}
	public function home($_data) {
		$view=$this -> view_dir."tasks.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		// TOP PARENT ONLY: $_SESSION['parent_id'] = $_SESSION['admin_id']; 
		 //persist parent id:
		 
		$view=$this -> view_dir."tasks.view.php";
		 
 		 $tasks = new tasks();
 
		$data = $tasks-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $tasks = new tasks();
 
		$data = $tasks-> read('json');
		 echo($data);
	}
	public function readToJSONByParentId($_data) {
		 
 		 $tasks = new tasks();
 
		$data = $tasks-> readByParentId($_SESSION['parent_id'],'json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=tasks_controller&m=paginate&where=where id='.$_data);
	}	public function read_parent_id($_data) {
			$view=$this -> view_dir."tasks.view.php"; $_SESSION['parent_id'] = $_data['parent_id']; $data = $_data; 	$this->buildView($view,$data);
	}
	public function edit($_data) {

		include_once("../models/tasks.model.php");
		$tasks = new tasks(); 
		$tasks->init($_data['id'],$_data['parent_id'],$_data['name'],$_data['owner'],$_data['priority'],$_data['description'],$_data['location'],$_data['files'],$_data['est_hours'],$_data['percent_complete'],$_data['est_dt']);
			$tasks->set_id($_data['id']);
		$tasks ->update($tasks);
		unset($tasks);
		$view=$this -> view_dir."tasks.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."tasks.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/tasks.model.php");
		$tasks = new Tasks(); 
		$tasks->init($_data['id'],$_SESSION['parent_id'],$_data['name'],$_data['owner'],$_data['priority'],$_data['description'],$_data['location'],$_data['files'],$_data['est_hours'],$_data['percent_complete'],$_data['est_dt']);
		$tasks ->create( $tasks);
		unset($tasks); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."tasks.delete.view.php";
		include("../models/tasks.model.php");
		$tasks = new tasks();
		$tasks->set_id($_data['id']);
		$tasks ->delete( $tasks);
		unset($tasks);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."tasks.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
