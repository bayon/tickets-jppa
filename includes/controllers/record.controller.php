<?php
	//CONTROLLER TEMPLATE

class record_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'record.view.php';
		$this -> view_dir = 'record/';
	}
	public function home($_data) {
		$view=$this -> view_dir."record.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."record.view.php";

 		 $record = new record();

		$data = $record-> read();
		$this->buildView($view,$data);
	} public function read_ModelKV($_data) {
  		$className = $_data['model'];
   		$object = new $className;
     		$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');
    		echo($data);

 }
	public function readToJSON() {

 		 $record = new record();

	//	$data = $record-> read('json');
			$data = $record-> read_parent_id($_SESSION['doc_id'],'json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=record_controller&m=paginate&where=where id='.$_data);
	}
	public function read_parent_id($_data) {
			$view=$this -> view_dir."record.view.php";
			 $_SESSION['doc_id'] = $_data['doc_id'];
			 $record = new record();

			$data = $record-> read_parent_id($_SESSION['doc_id']);

			$this->buildView($view,$data);
	}
	public function edit($_data) {

		include_once("../models/record.model.php");
		$record = new record();
		$record->init($_data['id'],$_data['name'],$_SESSION['admin_id'],$_data['doc_id'],$_data['title'],$_data['description'],$_data['updated']);
			$record->set_id($_data['id']);
		$record ->update($record);
		unset($record);
		$view=$this -> view_dir."record.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."record.create.view.php";

		 // include main includes for ajax only:
		include("../models/record.model.php");
		$record = new Record();
		$record->init($_data['id'],$_data['name'],$_SESSION['admin_id'],$_data['doc_id'],$_data['title'],$_data['description'],$_data['updated']);
		$record ->create( $record);
		unset($record);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."record.delete.view.php";
		include("../models/record.model.php");
		$record = new record();
		$record->set_id($_data['id']);
		$record ->delete( $record);
		unset($record);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."record.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') {
		build_view($view,$data);
	}
}
?>
