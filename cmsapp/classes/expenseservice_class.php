<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 10/12/2018
 ****************************************/ 
 ?>
<?php
class ExpenseService
{
	private $log;
 	public function __construct() {
 		$this->log=new Logging();
 	}
	public function addExpenses($expensecode,$narration,$amount,$transdate){
		$query = "insert into expenses_t ("
			   ."expensecode,transdate,narration,amount,createdby)"
			   ."values( "
			   .quote($expensecode).","	
			   .quote($transdate).","	
			   .quote($narration).","			  
			   .quote($amount).","			  
			  .quote('')
			   .")";		
		if($this->execute($query,"addExpenses")){
			return 1;
		}
		return 0;
	}
	public function updateExpenses($id,$code,$narration,$amount,$transDate){
			$query = "update expenses_t set "
				   ." expensecode = ".quote($code)."," 
				   ." transdate = ".quote($transDate)."," 
				   ."narration = ".quote($narration)."," 
				   ."amount = ".quote($amount)
					." where expenseid = ".quote($id);		
		if($this->executeUpdate($query,"update")){
			return 1;
		}
		return 0;
	}
	public function deleteExpenses($id){
		$query = "update expenses_t  "
				   ." set cancelled = 1 "
					." where expenseid = ".quote($id);		
		if($this->executeUpdate($query,"update")){
			return 1;
		}
		return 0;
	}	
	public function getData($id){
		$query = "select expenseid,expensecode,transdate,narration,amount,createdon,createdby,cancelled "
				   ." from expenses_t " 
				   ." where expenseid = ". $id ;	
		$results=$this->executeQuery($query,"getData");
		return $results;
	}
	public function isDataExistsOfHead($code){
		$query = "select count(expenseid) as cnt from expenses_t where expensecode = ". quote($code) ;	
		$results=$this->executeQuery($query,"isDataExistsOfHead");
		$dataCount=0;
		while($row=mysqli_fetch_array($results)){ 
			$dataCount=$row["cnt"];
		}
		$dataExists=false;
		if($dataCount>0)
			$dataExists=true;
		return $dataExists;
	}

	public function getExpenseEnteredToday($resultType,$frmDt, $toDt){
		return $this->getExpenseListForPeriodResults($resultType,0,"createdon",$frmDt, $toDt,0,999999);
	}		
	public function getExpenseListForPeriod($resultType,$frmDt, $toDt,$startNo=0,$blockSize=15){
		return $this->getExpenseListForPeriodResults($resultType,0,"transdate",$frmDt, $toDt,$startNo,$blockSize);
	}	
	public function getCancelledExpenseListForPeriod($resultType,$frmDt, $toDt,$startNo=0,$blockSize=15){
		return $this->getExpenseListForPeriodResults($resultType,1,"transdate",$frmDt, $toDt,$startNo,$blockSize);
	}
	private function getExpenseListForPeriodResults($resultType,$cancelled,$dateField,$frmDt, $toDt,$startNo=0,$blockSize=15){
		$toDt=addDaysWithDate($toDt,1);
		$whereString= " a.".$dateField." >= " . quote($frmDt) . " and a.".$dateField." <" . quote($toDt) 
						. " and a.cancelled=".quote($cancelled)." and a.expensecode=b.expensecode " ;

		if($resultType=='DATACOUNT'){
			$query = "Select count(a.expenseid) as cnt from expenses_t a, expense_head_t b  " . " where " .$whereString;
		}		
		else if($resultType=='SUMAMT'){
			$query = "Select sum(a.amount) as cnt from expenses_t a, expense_head_t b  " . " where " .$whereString;
		}
		else{
			$limit=" limit ".$startNo.",".$blockSize;
			$query = "Select " 
					. "a.expenseid,a.expensecode,a.transdate,a.narration,a.amount,a.createdon,a.createdby,a.cancelled,b.description  " 
						. " from expenses_t a, expense_head_t b   " . " where " .$whereString
						. " order by a.transdate,a.expenseid ".$limit;
		}
		$results= $this->executeQuery($query,"getExpenseListForPeriod"); 
		if($resultType=='DATACOUNT' || $resultType=='SUMAMT'){
			$dataCount=0;
			while($row=mysqli_fetch_array($results)){ 
				$dataCount=$row["cnt"];
			}
			return $dataCount;
		}
		return $results;
	}	
	
	public function getMonthlyExpenseSummary($myear){
		$frmDt=date('Y-m-d',strtotime($myear."/01/01"));
		$toDt=addYearWithDate($frmDt,1);
		$query = "select concat(year(a.transdate),month(a.transdate)) as period, " 
			. "sum(a.amount) as sumamt" 
			. " from expenses_t a" 
			. " where "
				. " a.transdate >= " . quote($frmDt) . " and a.transdate <" . quote($toDt) 
				. " and a.cancelled = 0 " 
			. " group by concat(year(a.transdate),month(a.transdate))";
		return $this->executeQuery($query,"getMonthlyExpenseSummary"); 	
	}
	public function getDailyExpenseSummary($month, $year){
		$query = "select day(a.transdate) as period, " 
				. " sum(a.amount) as sumamt" 
				. " from expenses_t a" 
				. " where "
				. " month(a.transdate) = " . quote($month) . " and year(a.transdate) = " . quote($year) 
				. " and a.cancelled = 0 " 
				. " group by day(a.transdate)";
	
		return $this->executeQuery($query,"getDailyExpenseSummary"); 
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