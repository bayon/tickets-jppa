<?php
	//CONTROLLER TEMPLATE
	
class publish_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'publish.view.php';
		$this -> view_dir = 'publish/';
	}
	public function home($_data) {
		$view=$this -> view_dir."publish.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."publish.view.php";
		 
 		 $publish = new publish();
 
		$data = $publish-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $publish = new publish();
 
		$data = $publish-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=publish_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/publish.model.php");
		$publish = new publish(); 
		$publish->init($_data['id'],$_data['name'],$_data['admin_id'],$_data['doc_id'],$_data['published']);
			$publish->set_id($_data['id']);
		$publish ->update($publish);
		unset($publish);
		$view=$this -> view_dir."publish.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."publish.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/publish.model.php");
		$publish = new Publish(); 
		$publish->init($_data['id'],$_data['name'],$_data['admin_id'],$_data['doc_id'],$_data['published']);
		$publish ->create( $publish);
		unset($publish); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."publish.delete.view.php";
		include("../models/publish.model.php");
		$publish = new publish();
		$publish->set_id($_data['id']);
		$publish ->delete( $publish);
		unset($publish);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."publish.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
