<?php
	//TIRE CONTROLLER TEMPLATE
	
class settings_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'settings.view.php';
		$this -> view_dir = 'settings/';
	}
	public function home($_data) {
		echo('home great success!!!');
		$view=$this -> view_dir."settings.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		echo('read great success!!!');
		$view=$this -> view_dir."settings.pagination.view.php";
		 
 		 $settings = new Settings();
 
		$data = $settings-> read();
		$this->buildView($view,$data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=settings_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {
		echo('edit great success!!!');

		include_once("../models/Settings.model.php");
		$settings = new Settings(); 
		$settings->init($_data['id'],$_data['name'],$_data['thing1'],$_data['thing2']);
			$settings->set_id($_data['id']);
		$settings ->update($settings);
		unset($settings);
		$view=$this -> view_dir."settings.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		echo('create great success!!!');
		$view=$this -> view_dir."settings.create.view.php";
 
		 // include main includes for ajax only:
		include("../models/Settings.model.php");
		$settings = new Settings(); 
		$settings->init($_data['id'],$_data['name'],$_data['thing1'],$_data['thing2']);
		$settings ->create( $settings);
		unset($settings); 
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		echo('delete great success!!!');
		$view=$this -> view_dir."settings.delete.view.php";
		include("../models/Settings.model.php");
		$settings = new Settings();
		$settings->set_id($_data['id']);
		$settings ->delete( $settings);
		unset($settings);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."settings.pagination.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
}
?>
