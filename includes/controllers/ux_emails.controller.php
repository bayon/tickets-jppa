<?php
	//CONTROLLER TEMPLATE
	
class ux_emails_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'ux_emails.view.php';
		$this -> view_dir = 'ux_emails/';
	}
	public function home($_data) {
		$view=$this -> view_dir."ux_emails.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."ux_emails.view.php";
		 
 		 $ux_emails = new ux_emails();
 
		$data = $ux_emails-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) { 
  		$className = $_data['model']; 
   		$object = new $className;  
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');   
    		echo($data);   
    	 
 } 
	public function readToJSON() {
		 
 		 $ux_emails = new ux_emails();
 
		$data = $ux_emails-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=ux_emails_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/ux_emails.model.php");
		$ux_emails = new ux_emails(); 
		$ux_emails->init($_data['id'],$_data['name'],$_data['description'],$_data['assigned'],$_data['created']);
			$ux_emails->set_id($_data['id']);
		$ux_emails ->update($ux_emails);
		unset($ux_emails);
		$view=$this -> view_dir."ux_emails.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."ux_emails.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/ux_emails.model.php");
		$ux_emails = new Ux_emails(); 
		$ux_emails->init($_data['id'],$_data['name'],$_data['description'],$_data['assigned'],$_data['created']);
		$ux_emails ->create( $ux_emails);
		unset($ux_emails); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."ux_emails.delete.view.php";
		include("../models/ux_emails.model.php");
		$ux_emails = new ux_emails();
		$ux_emails->set_id($_data['id']);
		$ux_emails ->delete( $ux_emails);
		unset($ux_emails);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."ux_emails.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
