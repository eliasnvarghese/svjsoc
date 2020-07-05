<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 10/12/2018
 ****************************************/ 
 ?>
<?php
class ExpenseHeadService
{
	private $log;
 	public function __construct() {
 		$this->log=new Logging();
 	} 


	public function addExpenseHead($description){		
		$query = "insert into expense_head_t ("
			   ." description)"
			   ."values( "
			   .quote($description)
			   .")";		
		if($this->execute($query,"addExpenseHead")){
			return 1;
		}
		return 0;
	}
	public function updateExpenseHead($code,$description){
		$query = "update expense_head_t  "
				   ." set description = ".quote($description)
					." where expensecode = ".quote($code);	
		if($this->executeUpdate($query,"updateExpenseHead")){
			return 1;
		}
		return 0;
	}
	public function deleteExpenseHead($code){
		$query = "update expense_head_t  "
				   ." set cancelled = 1 "
					." where expensecode = ".quote($code);		
		if($this->executeUpdate($query,"update")){
			return 1;
		}
		return 0;
	}	
	public function getData($expensecode){
	$query = "select expensecode,description,createdon,createdby,cancelled "
				   ." from expense_head_t " 
				   ." where expensecode = ". quote($expensecode) ;				   
		$results=$this->executeQuery($query,"getData");		
		return $results;
	}
	public function getAllDataList(){
	$query = "Select "
			   ."expensecode,description,dataorder,"
			   ." createdon,createdby,cancelled "
				   ." from expense_head_t " 
					   ." order by dataorder";
		$results=$this->executeQuery($query,"getAllDataList");
		return $results;
	}
	public function getActiveHeadList(){
	$query = "select "
			   ."expensecode,description,"
			   ." createdon,createdby,cancelled "
				   ." from expense_head_t "
				   ." where cancelled = 0 " ;
		$results=$this->executeQuery($query,"getActiveHeadList");
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


