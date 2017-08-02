<?php
	//CONTROLLER TEMPLATE
	
class prioritize_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'prioritize.view.php';
		$this -> view_dir = 'prioritize/';
	}
	public function home($_data) {
		$view=$this -> view_dir."prioritize.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."prioritize.view.php";
		 
 		 $prioritize = new prioritize();
 
		$data = $prioritize-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $prioritize = new prioritize();
 
		$data = $prioritize-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=prioritize_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/prioritize.model.php");
		$prioritize = new prioritize(); 
		$prioritize->init($_data['id'],$_data['name'],$_data['description'],$_data['business'],$_data['impact_benifit'],$_data['overall_rank'],$_data['mktg_cc_rank'],$_data['man_days'],$_data['duration'],$_data['contact'],$_data['priority'],$_data['type'],$_data['status'],$_data['dept'],$_data['responsible'],$_data['note']);
			$prioritize->set_id($_data['id']);
		$prioritize ->update($prioritize);
		unset($prioritize);
		$view=$this -> view_dir."prioritize.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."prioritize.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/prioritize.model.php");
		$prioritize = new Prioritize(); 
		$prioritize->init($_data['id'],$_data['name'],$_data['description'],$_data['business'],$_data['impact_benifit'],$_data['overall_rank'],$_data['mktg_cc_rank'],$_data['man_days'],$_data['duration'],$_data['contact'],$_data['priority'],$_data['type'],$_data['status'],$_data['dept'],$_data['responsible'],$_data['note']);
		$prioritize ->create( $prioritize);
		unset($prioritize); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."prioritize.delete.view.php";
		include("../models/prioritize.model.php");
		$prioritize = new prioritize();
		$prioritize->set_id($_data['id']);
		$prioritize ->delete( $prioritize);
		unset($prioritize);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."prioritize.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
