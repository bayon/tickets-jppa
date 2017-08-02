<?php
include_once('mySQLi.model.php');

class documents extends Model  {

	private $id;
	private $parent_id;
	private $name;
	private $type;
	private $url;
	private $date_created;

	function __construct(){
		parent::__construct();
	}
	public function model_connect() {
		return parent::connect();
	}
	function init($id,$parent_id,$name,$type,$url,$date_created){
		$this -> id = $id;
		$this -> parent_id = $parent_id;
		$this -> name = $name;
		$this -> type = $type;
		$this -> url = $url;
		$this -> date_created = $date_created;
	}
	public function set_id($id){
		$this -> id = $id;
	}
	public function get_id(){
		return $this -> id;
	}
	public function set_parent_id($parent_id){
		$this -> parent_id = $parent_id;
	}
	public function get_parent_id(){
		return $this -> parent_id;
	}
	public function set_name($name){
		$this -> name = $name;
	}
	public function get_name(){
		return $this -> name;
	}
	public function set_type($type){
		$this -> type = $type;
	}
	public function get_type(){
		return $this -> type;
	}
	public function set_url($url){
		$this -> url = $url;
	}
	public function get_url(){
		return $this -> url;
	}
	public function set_date_created($date_created){
		$this -> date_created = $date_created;
	}
	public function get_date_created(){
		return $this -> date_created;
	}

//---USE CASE (instantiate via POST array)---------------
//$documents = new documents( $_POST['id'], $_POST['parent_id'], $_POST['name'], $_POST['type'], $_POST['url'], $_POST['date_created']);


	public function read($return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".documents  WHERE parent_id = ".$_SESSION['admin_id'].";";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	}

	public function read_id($id = "",$return = "") {
		$con = $this -> model_connect();
		$sql = " SELECT * FROM " . $this -> getDatabase() . ".documents WHERE id='.$_data;";
		$data = $this -> exe_sql($con, $sql, $return);
		return $data;

	}

		public function publish($id = "",$return = "") {
				$con = $this -> model_connect();
				$sql = " SELECT * FROM " . $this -> getDatabase() . ".record WHERE doc_id='$id';";
				$data = $this -> exe_sql($con, $sql, $return);
				///NOW UPDATE THE DATE
				//	$con2 = $this -> model_connect();
				//$sql2 = "UPDATE ".$this -> getDatabase().".documents  set  date_created = '".global_timestamp()."'  WHERE id = ".$id."";
				//$data = $this -> exe_sql($con2, $sql2, $return);
				//return $sql;

				return $data;
     }






	 public function read_ModelKV($model='',$k = '',$v='',$return = '') {
  		$con = $this -> model_connect();
    		$sql = ' SELECT * FROM ' . $this -> getDatabase() . '.' . $model . ' WHERE ' . $k . '=' . $v . '; ';
   		$data = $this -> exe_sql($con, $sql, $return);
   		return $data;
    	}

//---SQL INSERT -------------------------------


	function create($documents,$return = "json") {
		$con = $this -> model_connect();
		$sql = "INSERT INTO ".$this -> getDatabase().".documents (id,parent_id,name,type,url,date_created)
		VALUES(null , '".$_SESSION['admin_id']."' , '".$documents->get_name()."' , '".$documents->get_type()."' , '".$documents->get_url()."' , '".global_timestamp()."' );";
	   $data = $this -> exe_sql($con,$sql, $return);
		 $id_last = $data;
		 // in the case of an insert , the return data will be the "last id inserted".
		 //write a file docs_.$data
		 //BASE_PATH:C:\xampp\htdocs\00_go\gomedia40\00_CommunityWall
		 //mkdir(BASE_PATH."\\includes\\docs\\docs_".$documents->get_parent_id());
        // $path_to_dir = BASE_PATH."\\includes\\docs\\admin_".$documents->get_parent_id();
         //mkdir('../stuff/newfolder', 0777, true);
        // if (!file_exists($path_to_dir)) {
          //  mkdir($path_to_dir, 0777, true);
      //  }
				global_mkdir($documents->get_parent_id());
				$url = BASE_URL."/includes/docs/admin_". $_SESSION['admin_id']."/doc_".$id_last.".json.php";
				//JUST SET THE URL
				$sql = "UPDATE ".$this -> getDatabase().".documents set     url = '".	$url."' , date_created = '".global_timestamp()."'  WHERE id = ". $id_last."";
				$data = $this -> exe_sql($con, $sql, $return);
				echo($data);

	 }
	 function update($documents,$return = "json") {
		$con = $this -> model_connect();
		$sql = "UPDATE ".$this -> getDatabase().".documents set id = '".$documents->get_id()."' , parent_id = '".$_SESSION['admin_id']."' , name = '".$documents->get_name()."' , type = '".$documents->get_type()."' , url = '".$documents->get_url()."' , date_created = '".global_timestamp()."'  WHERE id = ".$documents->get_id()."";
		$data = $this -> exe_sql($con, $sql, $return);
 		echo($data);
	}

	function delete($documents,$return = "json"){
		$con = $this -> model_connect();
		$sql = "DELETE FROM " . $this -> getDatabase() . ".documents WHERE id = " . $documents -> get_id() . "  ;";
		$data = $this -> exe_sql($con, $sql, $return);
		echo($data);
	}
	function create_table_documents(){
		$con = $this -> model_connect();
		$sql = " CREATE TABLE IF NOT EXISTS `documents` (`id` bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY(`id`), `parent_id`  tinytext NOT NULL, `name`  tinytext NOT NULL, `type`  tinytext NOT NULL, `url`  tinytext NOT NULL, `date_created`  tinytext NOT NULL)
		 ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='viaCodeWriter' AUTO_INCREMENT=1 ; " ;

		$data = $this -> exe_sql($con, $sql, $return);
}
	 }
?>
