<?php
	//CONTROLLER TEMPLATE

class documents_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'documents.view.php';
		$this -> view_dir = 'documents/';
	}
	public function home($_data) {
		$view=$this -> view_dir."documents.home.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function read($_data) {
		$view=$this -> view_dir."documents.view.php";
 		$documents = new documents();
		$data = $documents-> read();
		$this->buildView($view,$data);
	}

	public function read_ModelKV($_data) {
  		$className = $_data['model'];
   		$object = new $className;
     	$data = $object-> read_ModelKV($_data['model'],$_data['k'],$_data['v'],'json');
    	echo($data);
 }
	public function readToJSON() {

 		 $documents = new documents();
		$data = $documents-> read('json');
		 echo($data);
	}
	public function read_id($_data) {
	header('LOCATION: ?c=documents_controller&m=paginate&where=where id='.$_data);
	}
	public function edit($_data) {

		include_once("../models/documents.model.php");
		$documents = new documents();
		$documents->init($_data['id'],$_SESSION['admin_id'],$_data['name'],$_data['type'],$_data['url'],$_data['date_created']);
			$documents->set_id($_data['id']);
		$documents ->update($documents);
		unset($documents);
		$view=$this -> view_dir."documents.edit.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function create($_data) {
		$view=$this -> view_dir."documents.create.view.php";

		 // include main includes for ajax only:
		include("../models/documents.model.php");
		$documents = new Documents();
		$documents->init($_data['id'],$_SESSION['admin_id'],$_data['name'],$_data['type'],$_data['url'],$_data['date_created']);
		$documents ->create( $documents);
		unset($documents);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		$view=$this -> view_dir."documents.delete.view.php";
		include("../models/documents.model.php");
		$documents = new documents();
		$documents->set_id($_data['id']);
		$documents ->delete( $documents);
		unset($documents);
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
	$view=$this -> view_dir."documents.view.php";
		$data = $_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') {
		build_view($view,$data);
	}
	public function publish(){

			 $documents = new documents();
			 $data = $documents-> publish($_SESSION['doc_id'],'json'); //json
			 //create file
			 $parent_id = $_SESSION['admin_id'];
			 $doc_id = $_SESSION['doc_id'];//$documents->get_id();
			 global_fwrite($parent_id,$doc_id,$data);
	 	 		//echo($data);
			 //return $data;
			 //include("../models/publish.model.php");
			 $publish = new publish();
			 $publish->init(null,null,$_SESSION['admin_id'],$_SESSION['doc_id'],global_timestamp());
			 $publish ->create( $publish);
			 unset($publish);


	 }
}
?>
