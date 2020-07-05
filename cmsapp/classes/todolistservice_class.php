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
class ToDoListService
{
	private $log;
 	public function __construct() {
 		$this->log=new Logging();
 	} 

	public function addToDoList($description,$todoDate,$userId){		
		$query = "insert into todo_list_t ("
			   ."client_id,todo_date,description,createdon,createdby)"
			   ."values( "
			   .quote($_SESSION['edp_userData_ClientId']).","
			   .quote(getDbDate($todoDate)).","
			   .quote($description).","			   
			  . quote(date("Y-m-d H:i:s")) . "," 
			  .quote($userId)
			   .")";		
		if($this->execute($query,"addToDoList")){
			return 1;
		}
		return 0;
	}
	public function updateToDoList($todoId,$description,$todoDate){
		$query = "update todo_list_t  "
				   ." set description = ".quote($description). "," 
				   ." todo_date=". quote(getDbDate($todoDate))
					." where todo_id = ".quote($todoId) ." and client_id = ".quote($_SESSION['edp_userData_ClientId']);	
		if($this->executeUpdate($query,"updateToDoList")){
			return 1;
		}
		return 0;
	}
	public function deleteToDoList($todoId){
		$query = "update todo_list_t  "
				   ." set cancelled = 1 "
					." where todo_id = ".quote($todoId) ." and client_id = ".quote($_SESSION['edp_userData_ClientId']);		
		if($this->executeUpdate($query,"update")){
			return 1;
		}
		return 0;
	}	
	public function getDataById($todoId){
		$query = "select todo_id,todo_date,description,cancelled,createdon,createdby"
				   ." from todo_list_t " 
				   ." where todo_id = ". quote($todoId) ;				   
		$results=$this->executeQuery($query,"getDataById");		
		return $results;
	}	
	public function getToDoList(){
	$query = "select "
			   ."todo_id,todo_date,description,"
			   ." createdon,createdby,cancelled "
				   ." from todo_list_t "
				   ." where cancelled = 0 " ;
		$results=$this->executeQuery($query,"getToDoList");
		return $results;
	}

    /***** Private functions ***/
 	private function executeQuery($query,$agent=""){
 		try{
 			$this->log->debugLog($agent.": ".$query);
 			$this->sqlExec = new SqlExecution();
 			$this->sqlExec->executeQuery($query);
 			return $this->sqlExec->getResults();
 		}
 		catch(Exception $e) {
 			throw new Exception("Error while query execute..".$e->getMessage());
 		}
 	}
	private function execute($query,$agent=""){
 		try{
 			$this->log->debugLog($agent.": ".$query);
 			$this->sqlExec = new SqlExecution();
 			if($this->sqlExec->execute($query)){
 				return 1;
 			}
 			return 0;
 		}
 		catch(Exception $e) {
 			throw new Exception("Error while Insert..".$e->getMessage());
 		}
 	}
 	private function executeInsert($query,$agent="",$idRequired=true){
 		try{
 			$this->log->debugLog($agent.": ".$query);
 			$this->sqlExec = new SqlExecution();
 			if($this->sqlExec->execute($query)){
 				if($idRequired)
 					return mysqli_insert_id($this->sqlExec->getConn());
 				return 1;
 			}
 			return 0;
 		}
 		catch(Exception $e) {
 			throw new Exception("Error while Insert..".$e->getMessage());
 		}
 	}
 	private function executeUpdate($query,$agent=""){
 		try{
 			$this->log->debugLog($agent.": ".$query);
 			$this->sqlExec = new SqlExecution();
 			if($this->sqlExec->execute($query)){
 				return mysqli_affected_rows($this->sqlExec->getConn());
 			}
 			return 0;
 		}
 		catch(Exception $e) {
 			throw new Exception("Error while update..".$e->getMessage());
 		}
 	}
}
?>


