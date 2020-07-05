<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 10/12/2018
 ****************************************/ 
 ?>
<?php
class IncomeCategoryService
{
	private $log;
 	public function __construct() {
 		$this->log=new Logging();
 	} 


	public function addIncomeCategory($description){		
		$query = "insert into income_category_t ("
			   ." description)"
			   ."values( "
			   .quote($description)
			   .")";		
		if($this->execute($query,"addExpenseHead")){
			return 1;
		}
		return 0;
	}
	public function updateIncomeCategory($code,$description){
		$query = "update income_category_t  "
				   ." set description = ".quote($description)
					." where incomecode = ".quote($code);	
		if($this->executeUpdate($query,"updateIncomeCategory")){
			return 1;
		}
		return 0;
	}
	public function deleteIncomeCategory($code){
		$query = "update income_category_t  "
				   ." set cancelled = 1 "
					." where incomecode = ".quote($code);		
		if($this->executeUpdate($query,"update")){
			return 1;
		}
		return 0;
	}	
	public function getData($incomecode){
	$query = "select incomecode,description,createdon,createdby,cancelled "
				   ." from income_category_t " 
				   ." where incomecode = ". quote($incomecode) ;				   
		$results=$this->executeQuery($query,"getData");		
		return $results;
	}
	public function getAllDataList(){
	$query = "Select "
			   ."incomecode,description,dataorder,"
			   ." createdon,createdby,cancelled "
				   ." from income_category_t " 
					   ." order by dataorder";
		$results=$this->executeQuery($query,"getAllDataList");
		return $results;
	}
	public function getActiveCategoryList(){
	$query = "select "
			   ."incomecode,description,"
			   ." createdon,createdby,cancelled "
				   ." from income_category_t "
				   ." where cancelled = 0 " ;
		$results=$this->executeQuery($query,"getActiveCategoryList");
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


