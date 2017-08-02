<?php
	//CONTROLLER TEMPLATE
	
class notes_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'notes.view.php';
		$this -> view_dir = 'notes/';
	}
	public function home($_data) {
		$view=$this -> view_dir."notes.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."notes.view.php";
		 
 		 $notes = new notes();
 
		$data = $notes-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $notes = new notes();
 
		$data = $notes-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=notes_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/notes.model.php");
		$notes = new notes(); 
		$notes->init($_data['id'],$_data['title'],$_data['description'],$_data['created']);
			$notes->set_id($_data['id']);
		$notes ->update($notes);
		unset($notes);
		$view=$this -> view_dir."notes.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."notes.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/notes.model.php");
		$notes = new Notes(); 
		$notes->init($_data['id'],$_data['title'],$_data['description'],$_data['created']);
		$notes ->create( $notes);
		unset($notes); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."notes.delete.view.php";
		include("../models/notes.model.php");
		$notes = new notes();
		$notes->set_id($_data['id']);
		$notes ->delete( $notes);
		unset($notes);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."notes.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
