<?php
/****************************************
 * @Project     : DentalApp
 * @Version     :  1.0.0
 * @Author by	:  
 * @Created Date : 
 * @modified by	: Anju NK
 * @modified date: 24/07/2014
 ****************************************/ 
 ?>
<?php
class PaymentService
{
	private $log;
 	public function __construct() {
 		$this->log=new Logging();
 	} 
	public function add($uid, $rectdate, $categorycode, $rectdetls, $rectamount, $createdby){
			$query = "insert into cashreceipt_t (" 
					. "uid, rectdate, categorycode, rectdetls, rectamount, createdby)" 
					. "values( " 
						. quote($uid) . "," 
						. quote($rectdate) . "," 
						. quote($categorycode) . "," 
						. quote($rectdetls) . "," 
						. quote($rectamount) . "," 
						.quote($createdby)
			   .")";
		return $this->executeInsert($query,"add");
	}
	public function update($uid,$rectno, $rectDate,  $categorycode, $rectdetls, $rectamount){
			$query = "update cashreceipt_t set " 
					. " rectdate = " . quote($rectDate) . "," 
					. " categorycode  = " . quote($categorycode) . "," 
					. " rectdetls = " . quote($rectdetls) . "," 
					. " rectamount = " . quote($rectamount) 
					. " where uid = " . quote($uid) . " and rectno = " . quote($rectno)  ;
		return $this->executeUpdate($query,"update");
	}
	public function cancelCashReceipt($uid,$rectno){
			$query = "update cashreceipt_t  set " 
					. " cancelled = 1 " 
					. " where uid = " . quote($uid) . " and rectno = " .quote($rectno) ;
		return $this->executeUpdate($query,"cancelCashReceipt");
	}
	public function getData($rectno){
		$ObjCashReceipt=null;
		$query = "select rectno, uid,serialno,rectdate,categorycode, rectdetls,rectamount,cancelled, createdon,createdby " 
					. " from cashreceipt_t " 
					. " where rectno = " . quote($rectno) ;
		$results=$this->executeQuery($query,"getData"); 
		while($row=mysqli_fetch_array($results)){ 
			$ObjCashReceipt = New CashReceipt();
			$ObjCashReceipt->setRectno($row['rectno']);
			$ObjCashReceipt->setUid($row['uid']);
			$ObjCashReceipt->setSerialno($row['serialno']);
			$ObjCashReceipt->setRectdate($row['rectdate']);
			$ObjCashReceipt->setCategoryCode($row['categorycode']);
			$ObjCashReceipt->setRectdetls($row['rectdetls']);
			$ObjCashReceipt->setRectamount($row['rectamount']);
			$ObjCashReceipt->setCancelled($row['cancelled']);
			$ObjCashReceipt->setCreatedon($row['createdon']);
			$ObjCashReceipt->setCreatedby($row['createdby']);
		}
		return $ObjCashReceipt;
	}	
	public function getReceipt($uid,$rectno){
		$ObjCashReceipt=null;
		$query = "select rectno, uid,serialno,rectdate,categorycode, rectdetls,rectamount,cancelled, createdon,createdby " 
					. " from cashreceipt_t " 
					. " where rectno= " . quote($rectno) . " and uid=".quote($uid);
			
		$results=$this->executeQuery($query,"getReceipt"); 
	
		while($row=mysqli_fetch_array($results)){ 
			$ObjCashReceipt = New CashReceipt();
			$ObjCashReceipt->setRectno($row['rectno']);
			$ObjCashReceipt->setUId($row['uid']);
			$ObjCashReceipt->setSerialno($row['serialno']);	
			$ObjCashReceipt->setRectdate($row['rectdate']);
			$ObjCashReceipt->setCategoryCode($row['categorycode']);
			$ObjCashReceipt->setRectdetls($row['rectdetls']);
			$ObjCashReceipt->setRectamount($row['rectamount']);
			$ObjCashReceipt->setCancelled($row['cancelled']);
			$ObjCashReceipt->setCreatedon($row['createdon']);
			$ObjCashReceipt->setCreatedby($row['createdby']);
		}
		return $ObjCashReceipt;
	}

	public function getLedger($uid){
		$query = "SELECT a.uid,a.serialno, a.rectdate ,a.rectno, a.rectamount,a.categorycode,c.description as category, a.rectdetls "
				."FROM cashreceipt_t a "
				." LEFT JOIN income_category_t c ON a.categorycode = c.incomecode"
				. " where a.cancelled=0 and a.uid= " . quote($uid) 
				." ORDER BY a.rectno desc  " ;
		return $this->executeQuery($query,"getLedger"); 
	}
	
	public function getMemberLedger($resultType,$regUid,$frmDt, $toDt,$startNo=0,$blockSize=15){
		return $this->getReceiptListForPeriodResults($resultType,0,$regUid,$frmDt, $toDt,$startNo,$blockSize);
	}	
	public function getReceiptListForPeriod($resultType,$frmDt, $toDt,$startNo=0,$blockSize=15){
		return $this->getReceiptListForPeriodResults($resultType,0,0,$frmDt, $toDt,$startNo,$blockSize);
	}
	public function getCancelledReceiptListForPeriod($resultType,$frmDt, $toDt,$startNo=0,$blockSize=15){
		return $this->getReceiptListForPeriodResults($resultType,1,0,$frmDt, $toDt,$startNo,$blockSize);
	}
	private function getReceiptListForPeriodResults($resultType,$cancelled,$regUid=0,$frmDt, $toDt,$startNo,$blockSize){
		$toDt=addDaysWithDate($toDt,1);
		$whereString= " a.cancelled=".quote($cancelled)." and a.rectdate >= " . quote($frmDt) . " and a.rectdate <" . quote($toDt) ;
		if($regUid!=0)
		{
			$whereString .= " and a.uid = " . quote($regUid) ;
		}			
		if($resultType=='DATACOUNT'){
			$query = "Select count(a.rectno) as cnt from cashreceipt_t a, userregistration_t b  where " .$whereString  . " and a.uid=b.uid " ;
		}
		else if($resultType=='SUMRECT'){
			$query = "Select sum(a.rectamount) as cnt from cashreceipt_t a, userregistration_t b  where " .$whereString . " and a.uid=b.uid " ;
		}
		else
		{
			$limit=" limit ".$startNo.",".$blockSize;
			$query = "Select " 
					. "a.rectno, a.uid,a.serialno,a.rectdate,a.categorycode,c.description as category, a.rectdetls,a.rectamount,"
					."a.cancelled, a.createdon,a.createdby," 
					. "b.name ,b.fulladdress ,b.city ,b.state ,b.zipcode ,b.phonenumber ,b.mobilenumber , b.dob ,b.gender  " 
						. " from cashreceipt_t a" 
						." LEFT JOIN userregistration_t b  ON a.uid = b.uid "
						." LEFT JOIN income_category_t c ON a.categorycode = c.incomecode"
					. " where " . $whereString
							. " order by a.rectdate ".$limit;
		}
		$results= $this->executeQuery($query,"getReceiptListForPeriod"); 
		if($resultType=='DATACOUNT' || $resultType=='SUMRECT'){
			$dataCount=0;
			while($row=mysqli_fetch_array($results)){ 
				$dataCount=$row["cnt"];
			}
			return $dataCount;
		}
		return $results;
	}	

	public function getMonthlyCollectionSummary($myear){
		$frmDt=date('Y-m-d',strtotime($myear."/01/01"));
		$toDt=addYearWithDate($frmDt,1);
		$query = "select concat(year(rectdate),month(rectdate)) as period, sum(rectamount) as sumamt" 
			. " from cashreceipt_t a" 
			. " where "
				. " a.rectdate >= " . quote($frmDt) . " and a.rectdate <=" . quote($toDt) 
				. " and a.cancelled = 0 " 
			. " group by concat(year(a.rectdate),month(a.rectdate))";
		return $this->executeQuery($query,"getMonthlyCollectionSummary"); 	
	}
	public function getDailyCollectionSummary($month, $year){
		$query = "select day(rectdate) as period, " 
				. " sum(rectamount) as sumamt" 
				. " from cashreceipt_t  a " 
				. " where "
				. " month(a.rectdate) = " . quote($month) . " and year(a.rectdate) = " . quote($year) 
				. " and a.cancelled = 0 " 
				. " group by day(a.rectdate)";
	
		return $this->executeQuery($query,"getDailyCollectionSummary"); 
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