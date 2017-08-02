<?php
//require_once('./constants.php');
include_once('global.model.functions.php');

 
class Model {
	private $database;
	private $host;
	private $username;
	private $password;
	function __construct() {
		$this -> database = DATABASE;
		$this -> host = HOST;
		$this -> username = USERNAME;
		$this -> password = PASSWORD;
	}

	public function getDatabase() {
		 
		return $this -> database;
	}

	public function setDatabase($database) {
		$this -> database = $database;
	}

	public function connect() {
		//mysql_connect($this -> host, $this -> username, $this -> password);
		$con = mysqli_connect($this -> host, $this -> username, $this -> password);
		return $con;
	}

	public function exe_sql($con, $sql, $return = "") {
		$res = mysqli_query($con, $sql);
		
		if (mysqli_connect_errno())
		  {
		  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
		   $result_e =  "Failed to connect to MySQL: " . mysqli_connect_error();
		  return ($result_e );
		  }
		  
		if (gettype($res) == "boolean") {
			//INSERT creates a boolean for $res
			//return last id
			return mysqli_insert_id($con);
		}
		// L E F T   O F F   H E R E   switching over to mysqli
		$data = "";
		while ($row = mysqli_fetch_assoc($res)) {
			$data[] = $row;
		}
		// Free result set
		mysqli_free_result($res);
		mysqli_close($con);
		//return "foo";
		//return $sql;
		if ($return == "json") {
			return json_encode($data);
			
		} else {
			return $data;
		}
	}

	 

}
?>