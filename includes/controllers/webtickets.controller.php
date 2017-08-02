<?php
	//CONTROLLER TEMPLATE
	
class webtickets_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'webtickets.view.php';
		$this -> view_dir = 'webtickets/';
	}
	public function home($_data) {
		$view=$this -> view_dir."webtickets.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		 $_SESSION['parent_id'] = $_SESSION['admin_id']; 
		$view=$this -> view_dir."webtickets.view.php";
		 
 		 $webtickets = new webtickets();
 
		$data = $webtickets-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $webtickets = new webtickets();
 
		$data = $webtickets-> read('json');
		 echo($data);
	}
	public function readToJSONByParentId($_data) {
		 
 		 $webtickets = new webtickets();
 
		$data = $webtickets-> readByParentId($_SESSION['parent_id'],'json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=webtickets_controller&m=paginate&where=where id='.$_data);
	}	public function read_parent_id($_data) {
			$view=$this -> view_dir."webtickets.view.php"; $_SESSION['parent_id'] = $_data['parent_id']; $data = $_data; 	$this->buildView($view,$data);
	}
	public function edit($_data) {

		include_once("../models/webtickets.model.php");
		$webtickets = new webtickets(); 
		$webtickets->init($_data['id'],$_data['parent_id'],$_data['name'],$_data['date'],$_data['phase1'],$_data['phase2'],$_data['phase3']);
			$webtickets->set_id($_data['id']);
		$webtickets ->update($webtickets);
		unset($webtickets);
		$view=$this -> view_dir."webtickets.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."webtickets.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/webtickets.model.php");
		$webtickets = new Webtickets(); 
		$webtickets->init($_data['id'],$_SESSION['parent_id'],$_data['name'],$_data['date'],$_data['phase1'],$_data['phase2'],$_data['phase3']);
		$webtickets ->create( $webtickets);
		unset($webtickets); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."webtickets.delete.view.php";
		include("../models/webtickets.model.php");
		$webtickets = new webtickets();
		$webtickets->set_id($_data['id']);
		$webtickets ->delete( $webtickets);
		unset($webtickets);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."webtickets.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
