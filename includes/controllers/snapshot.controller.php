<?php
	//CONTROLLER TEMPLATE
	
class snapshot_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'snapshot.view.php';
		$this -> view_dir = 'snapshot/';
	}
	public function home($_data) {
		$view=$this -> view_dir."snapshot.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."snapshot.view.php";
		 
 		 $snapshot = new snapshot();
 
		$data = $snapshot-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $snapshot = new snapshot();
 
		$data = $snapshot-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=snapshot_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/snapshot.model.php");
		$snapshot = new snapshot(); 
		$snapshot->init($_data['id'],$_data['name'],$_data['description'],$_data['created_dt']);
			$snapshot->set_id($_data['id']);
		$snapshot ->update($snapshot);
		unset($snapshot);
		$view=$this -> view_dir."snapshot.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."snapshot.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/snapshot.model.php");
		$snapshot = new Snapshot(); 
		$snapshot->init($_data['id'],$_data['name'],$_data['description'],$_data['created_dt']);
		$snapshot ->create( $snapshot);
		unset($snapshot); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function snapshot($_data) {
		 
 		//echo('hogwash');die();
		 // include main includes for ajax only:
		include("../models/snapshot.model.php");
		$snapshot = new Snapshot(); 
		$snapshot->init($_data['id'],$_data['name'].global_timestamp(),$_data['description'],$_data['created_dt']);
		$snapshot ->create( $snapshot);
		unset($snapshot); 
		//$data = $_data;
		//$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."snapshot.delete.view.php";
		include("../models/snapshot.model.php");
		$snapshot = new snapshot();
		$snapshot->set_id($_data['id']);
		$snapshot ->delete( $snapshot);
		unset($snapshot);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."snapshot.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
