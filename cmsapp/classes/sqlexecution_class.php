<?php
/*
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	:
 * @modified date:
 */
?>
<?php require_once("databaseconnection_class.php"); ?>
<?php
/*
* SqlExecution
*
*/
class SqlExecution
{

	private $results;
	public $dbCon;

	public function getResults()
	{
		return $this->results;
	}

	public function clearResults()
	{
		mysqli_free_result($this->results);
	}

	public function __construct()
	{
		$db = new DatabaseConnection();
		$this->dbCon=$db->db_open();
	}
	
	public function getConn()
	{
		return $this->dbCon;
	}

	//Public Mehtods Starts Here
	public function execute($sqlString)
	{
		$result= mysqli_query($this->dbCon,$sqlString);
		if(mysqli_errno($this->dbCon))
			throw new Exception("Query failed with error: ".mysqli_error($this->dbCon));
		return $result;
	}

	public function executeUpdate($sqlString)
	{
		$result= mysqli_query($this->dbCon,$sqlString);
		if(mysqli_errno($this->dbCon))
			throw new Exception("Query failed with error: ".mysqli_error($this->dbCon));
		$affctedrows=mysqli_affected_rows($this->sqlExec->getConn());
		return $affctedrows;
	}
	
	public function executeQuery($sqlString)
	{
		$this->results = mysqli_query($this->dbCon,$sqlString);
		if(mysqli_errno($this->dbCon))
		{
			//$this->results=NULL;
			throw new Exception("Query failed with error: ".mysqli_error($this->dbCon));
		}
	}

	public function executeStoredProc($storedProc)
	{
		try{
			//mysqli_free_result($this->results) or die("");
		}catch(Exception $ignored){}
		$this->results = mysqli_query($this->dbCon,$sqlString)  or die("Query failed with error: ".mysqli_error($this->dbCon));
	}

	public function executeStoredProcQuery($storedProc)
	{
		try{
			//mysqli_free_result($this->results) or die("");
		}catch(Exception $ignored){}
		$this->results = mysqli_query($this->dbCon,$storedProc)  or die("Query failed with error: ".mysqli_error($this->dbCon));
	}

	public function updateStringData($id,$tableName,$whereColumn,$updColumn,$value)
	{
		$stat=0;
		try{
			$query="update ".$tableName." set "
				.trim($updColumn)." = ".quote($value)
					." where  ".trim($whereColumn)." = ".$id;
			if($this->execute($this->dbCon,$query))
				$stat=1;
			return $stat;
		}
		catch(Exception $e){
			throw new Exception("Cannot update  .....".$e->getMessage());
		}
		return $stat;
	}

	public function updateNumericData($id,$tableName,$whereColumn,$updColumn,$value)
	{
		$stat=0;
		try{
			$query="update ".$tableName." set "	.trim($updColumn)." = ".$value
						." where  ".trim($whereColumn)." = ".$id;
			if($this->execute($this->dbCon,$query))
				$stat=1;
			return $stat;
		}
		catch(Exception $e){
			throw new Exception("Cannot update  .....".$e->getMessage());
		}
		return $stat;
	}

	public function increaseNumericData($id,$tableName,$whereColumn,$updColumn,$value)
	{
		$stat=0;
		try{
			$query="update ".$tableName." set " .trim($updColumn)." = ".trim($updColumn)." + ".$value
						." where  ".trim($whereColumn)." = ".$id;
			if($this->execute($this->dbCon,$query))
				$stat=1;
			return $stat;
		}
		catch(Exception $e){
			throw new Exception("Cannot update  .....".$e->getMessage());
		}
		return $stat;
	}

	public function closeConnection()
	{
		//$dbCon->db_close();
	}
	public function rollBack()
	{
		//$dbCon->db_close();
	}

	public function getArray()
	{
		$fieldcount=mysqli_num_fields($this->results);
		$resultData=array();
		$fields=array();
		while ($fieldinfo=mysqli_fetch_field($results))
		{
			$fields[]=$fieldinfo->name;
		}
		$i=0;
		while ($row = mysqli_fetch_array ($this->results))
		{
			$rowV=array();
			for($i=0;$i<$fieldcount;$i++)
			{
				$rowV[$fields[$i]]=$row[$i];
			}
			$resultData[]=$rowV;
		}
		mysqli_free_result ($this->results);
		return $resultData;
	}
	
	public static function getResultArray($results)
	{
		$fieldcount=mysqli_num_fields($results);
		$resultData=array();
		$fields=array();
		$i=0;
		while ($fieldinfo=mysqli_fetch_field($results))
		{
			$fields[]=$fieldinfo->name;
		}
		while ($row = mysqli_fetch_array ($results))
		{
			$rowV=array();
			for($i=0;$i<$fieldcount;$i++)
			{
				$rowV[$fields[$i]]=$row[$i];
			}
			$resultData[]=$rowV;
		}
		mysqli_free_result ($results);
		return $resultData;
	}
}
?>
