<?php
/****************************************
 * @Project     :  St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php
/*
* Message Service
*
*/
class EnquiryService
{
	private $log;

	public function __construct()
	{
		$this->log=new Logging();
	}
	
	public function addEnquiry($enquiryObj){
		$stat=0;
		try{
			$query="insert into enquiry_feedback_t(sendername,email,mobile,subject,message,createdon)"
			."values("
				.quote($enquiryObj->getSenderName()).","
				.quote($enquiryObj->getEmail()).","
				.quote($enquiryObj->getMobile()).","
				.quote($enquiryObj->getSubject()).","
				.quote($enquiryObj->getMessage()).","
				.quote(date('Y-m-d H:i:s'))
			.")";
			$this->log->userLog("query..".$query);
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))	{
				$stat=1;
				$this->log->userLog("enquiry Save. success..");
			}
			else{
				$this->log->userLog("enquiry Save failed...");
			}
		}catch(Exception $e){
			$this->log->userLog("enquiry Save failed...");
		}
		return $stat;
	}
	
	/****************************************************
	* Enquiries from  GUEST  to churchteam Admin   **
	*****************************************************/
	public function getEnquiries($resultType,$email,$startNo=0,$blockSize=9)
	{
		$searchStr="";
		$limit=" LIMIT $startNo, $blockSize";

		if($email=='all')
			$searchStr="";
		else
			$searchStr=" and a.email = ". quote($email);
		try	{	
			if($resultType=='DATACOUNT')
 				$query = "select count(messageid) as cnt from enquiry_feedback_t a where a.fromuid=0 ".$searchStr;
			else{
				$query = "select a.messageid,a.sendername,a.email,a.mobile,"
							."a.subject,a.message,a.createdon,a.status,a.tag"
							." from  enquiry_feedback_t a"
								." where a.status=0 ".$searchStr
									." order by a.createdon desc ".$limit;
			}
			$this->log->userLog("Query : ".$query);
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			$results= $this->sqlExec->getResults();
 			if($resultType=='DATACOUNT'){
 				while($row=mysqli_fetch_array($results)){ 
 					$cnt=$row['cnt'];
 				}
 				return $cnt;
 			}
 			return $results;
		}
		catch(Exception $e)	{
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
	
	
}
?>