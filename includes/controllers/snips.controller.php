<?php
	//CONTROLLER TEMPLATE
	
class snips_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'snips.view.php';
		$this -> view_dir = 'snips/';
	}
	public function home($_data) {
		$view=$this -> view_dir."snips.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."snips.view.php";
		 
 		 $snips = new snips();
 
		$data = $snips-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $snips = new snips();
 
		$data = $snips-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=snips_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/snips.model.php");
		$snips = new snips(); 
		$snips->init($_data['id'],$_data['name'],$_data['description'],$_data['code'],$_data['language'],$_data['created'],$_data['modified']);
			$snips->set_id($_data['id']);
		$snips ->update($snips);
		unset($snips);
		$view=$this -> view_dir."snips.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."snips.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/snips.model.php");
		$snips = new Snips(); 
		$snips->init($_data['id'],$_data['name'],$_data['description'],$_data['code'],$_data['language'],$_data['created'],$_data['modified']);
		$snips ->create( $snips);
		unset($snips); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."snips.delete.view.php";
		include("../models/snips.model.php");
		$snips = new snips();
		$snips->set_id($_data['id']);
		$snips ->delete( $snips);
		unset($snips);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."snips.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
