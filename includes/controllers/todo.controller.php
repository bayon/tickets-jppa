<?php
	//CONTROLLER TEMPLATE
	
class todo_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'todo.view.php';
		$this -> view_dir = 'todo/';
	}
	public function home($_data) {
		$view=$this -> view_dir."todo.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."todo.view.php";
		 
 		 $todo = new todo();
 
		$data = $todo-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $todo = new todo();
 
		$data = $todo-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=todo_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/todo.model.php");
		$todo = new todo(); 
		//$todo->init($_data['id'],$_data['name'],$_data['description'],$_data['notes'],$_data['completed']);
		$todo->init($_data['id'],$_data['name'],$_data['description'],$_data['notes'],$_data['completed'],$_data['percent'],$_data['due']);
		$todo->set_id($_data['id']);
		$todo ->update($todo);
		unset($todo);
		$view=$this -> view_dir."todo.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		//$view=$this -> view_dir."todo.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/todo.model.php");
		$todo = new Todo(); 
		//$todo->init($_data['id'],$_data['name'],$_data['description'],$_data['notes'],$_data['completed']);
		$todo->init($_data['id'],$_data['name'],$_data['description'],$_data['notes'],$_data['completed'],$_data['percent'],$_data['due']);
		$data = $todo ->create( $todo);
		unset($todo); 
		 echo($data);
		//$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."todo.delete.view.php";
		include("../models/todo.model.php");
		$todo = new todo();
		$todo->set_id($_data['id']);
		$todo ->delete( $todo);
		unset($todo);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."todo.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
