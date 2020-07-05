<?php 
class ContentService
{
	private $log;
 	public function __construct() {
 		$this->log=new Logging();
 	}

	public function getGospel(){
		$query = "select * from gospel_t where deleted = 0 order by rand() limit 1" ;
		$results= $this->executeQuery($query,"getGospel"); 
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