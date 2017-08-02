<?php


class main_controller {
	private $instanceName;
	private $view;
	private $view_dir;
	function __construct() {
		$this -> instanceName = 'default';
		$this -> view = 'main.home.view.php';
		$this -> view_dir = 'main/';
	}
	 public function home($_data) {
		echo('home great success!!!');
		$view=$this -> view_dir."main.home.view.php";
		$data=$_data;
		$this->buildView($view,$data);
	}
	
	public function read($_data) {
		echo('read great success!!!');
		$view=$this -> view_dir."main.home.view.php";
		$data=$_data;
		$this->buildView($view,$data);
		//$view="test.pagination.view.php";
		//$this->buildView($view,$data);
	}
	public function sublimeshortcuts($_data) {
		 
		$view=$this -> view_dir."main.sublimeshortcuts.view.php";
		$data=$_data;
		$this->buildView($view,$data);
		 
	}
	public function edit($_data) {
		echo('edit great success!!!');
$view=$this -> view_dir."main.home.view.php";		$data=$_data;
		$this->buildView($view,$data);
	}
	
	public function create($_data) {
		echo('create great success!!!');
$view=$this -> view_dir."main.home.view.php";		$data=$_data;
		$this->buildView($view,$data);
	}
	public function delete($_data) {
		echo('delete great success!!!');
$view=$this -> view_dir."main.home.view.php";		$data=$_data;
		$this->buildView($view,$data);
	}
	public function save($_data) {
		echo('save great success!!!');
$view=$this -> view_dir."main.home.view.php";		$data=$_data;
		$this->buildView($view,$data);
	}
	public function cancel($_data) {
		echo('cancel great success!!!');
$view=$this -> view_dir."main.home.view.php";		$data=$_data;
		$this->buildView($view,$data);
	}
	public function paginate($_data) {
			
			//echo("<pre>"); print_r($_data);echo("</pre>"); 
		//build_view($view,$data);
			$view=$this -> view_dir."user.pagination.view.php";
			$data=$_data;
		$this->buildView($view,$data);
	}
	public function buildView($view='',$data='') { 
		build_view($view,$data);
	}
	 
	 
}

?>