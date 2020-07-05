<?php 
class SummaryService
{
	private $log;
 	public function __construct() {
 		$this->log=new Logging();
 	}
	/***************** Registration summary **************/
	public function getTotalRegSummary(){
		$query = "select count(a.uid) as cnt from userregistration_t a where a.deleted = 0 ";
		$results= $this->executeQuery($query,"getTotalRegSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
	}	
	public function getThisMonthRegSummary(){
		$month=date("m"); 	$year=date("Y");
		$query = "select count(a.uid) as cnt from userregistration_t a" 
				. " where month(a.createdon) = " . quote($month) . " and year(a.createdon) = " . quote($year) 
					. " and a.deleted = 0 " ;
		$results= $this->executeQuery($query,"getThisMonthRegSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
	}
	public function getTodaysRegSummary(){
		$day=date("d");		$month=date("m");
		$year=date("Y");
		$query = "select count(a.uid) as cnt from userregistration_t a" 
				. " where "
					. " day(a.createdon)=".quote($day)." and month(a.createdon)=".quote($month)." and year(a.createdon)=".quote($year) 
						. " and a.deleted = 0 " ;
		$results= $this->executeQuery($query,"getTodaysRegSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
	}
	/****************** Event Summary ***************/
	public function getTotalEvntSummary(){
		$query = "select count(a.eventid) as cnt from events_t a where deleted = 0";
		$results= $this->executeQuery($query,"getTotalEvntSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
	}	
	public function getThisMonthEvntSummary(){
		$month=date("m"); 	$year=date("Y");
		$query = "select count(a.eventid) as cnt from events_t a where deleted = 0" 
				. " and  month(a.fromdate) = " . quote($month) . " and year(a.fromdate) = " . quote($year) ;
		$results= $this->executeQuery($query,"getThisMonthEvntSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
	}
	public function getTodaysEvntSummary(){
		$day=date("d");		$month=date("m");
		$year=date("Y");
		$query = "select count(a.eventid) as cnt from events_t a where deleted = 0" 
					. " and day(a.fromdate)=".quote($day)." and month(a.fromdate)=".quote($month)." and year(a.fromdate)=".quote($year) ;
		$results= $this->executeQuery($query,"getTodaysEvntSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
	}
/****************** Message Summary ***************/
	public function getTotalMesgSummary(){
		$query = "select count(a.touid) as cnt from messages_t a where toaddress='churchteam'";
		$results= $this->executeQuery($query,"getTotalMesgSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
	}	
	public function getThisMonthMesgSummary(){
		$month=date("m"); 	$year=date("Y");
		$query = "select count(a.touid) as cnt from messages_t a" 
				. " where month(a.createdon) = " . quote($month) . " and year(a.createdon) = " . quote($year) 
					. " and toaddress='churchteam'" ;
		$results= $this->executeQuery($query,"getThisMonthMesgSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
	}
	public function getTodaysMesgSummary(){
		$day=date("d");		$month=date("m");
		$year=date("Y");
		$query = "select count(a.touid) as cnt from messages_t a" 
				. " where "
					. " day(a.createdon)=".quote($day)." and month(a.createdon)=".quote($month)." and year(a.createdon)=".quote($year) 
						. " and toaddress='churchteam'" ;
		$results= $this->executeQuery($query,"getTodaysMesgSummary"); 
		$cnt=0;
		while($row=mysqli_fetch_array($results)){
			$cnt=$row["cnt"];
		}
		return $cnt;
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