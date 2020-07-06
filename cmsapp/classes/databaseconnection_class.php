<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php
/*
* DatabaseConnection
*
*/
class DatabaseConnection
{
	private $db_host="localhost";
	private $db_user="ststephenchurch";
	private $db_password="sts[9X*123*";
	private $db="ststephenchurchdb";
	private $conn;

	function __construct(){
		if($_SERVER["HTTP_HOST"]=="127.0.0.1" || $_SERVER["HTTP_HOST"]=="localhost"){
			$this->setConnection();
		}
	}
	function setConnection(){
	
		$this->db_host="localhost";
		$this->db_user="root";
		$this->db_password="";
		$this->db="ststephendb";
		
	}

	function setLocalConnection(){
	
		$this->db_host="localhost";
		$this->db_user="root";
		$this->db_password="";
		$this->db="ststephendb";
		
	}

	function db_open()
	{
		try{
			$this->conn=new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db);
			if(!$this->conn)
				throw new Exception("Can't connect to Database");
			/* if(!@mysqli_select_db($this->db))
				throw new Exception("Can't Select Database"); */
			}catch(Exception $e){
				echo $e->getMessage();
			}
			return $this->conn;
	}

	function db_close(){
		mysqli_close($this->conn);
	}

}
?>
