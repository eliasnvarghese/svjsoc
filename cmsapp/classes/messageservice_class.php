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
class MessageService
{
	private $log;

	public function __construct()
	{
		$this->log=new Logging();
	}
	
	public function addMessage($messageObj)
	{
		$stat=0;
		try{
			$query="insert into messages_t(fromuid,fromaddress,touid,toaddress,subject,message,createdon)"
			."values("
				.quote($messageObj->getFromUid()).","
				.quote($messageObj->getFromAddress()).","
				.quote($messageObj->getToUid()).","
				.quote($messageObj->getToAddress()).","
				.quote($messageObj->getSubject()).","
				.quote($messageObj->getMessage()).","
				.quote(date('Y-m-d H:i:s'))
			.")";
			$this->log->userLog("query..".$query);
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))	{
				$stat=1;
				$this->log->userLog("message Save. success..");
			}
			else{
				$this->log->userLog("message Save failed...");
			}
		}catch(Exception $e){
			$this->log->userLog("message Save failed...");
		}
		return $stat;
	}
	
	public function readMessage($messageId)
	{
		$stat=0;
		try{
			$query="update message "
						." set status=1"
							." where messageid =".$messageId . " and status = 0";
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query)){
				$stat=1;
				$this->log->userLog("message Read. success..");
			}
			else{
				$this->log->userLog("message Read failed...");
			}
		}catch(Exception $e){
			$this->log->userLog("message Read failed...");
		}
		return $stat;
	}
	/****************************************************
	* Sent Messages to the user from churchteam Admin **
	*****************************************************/
	public function getMyInMessages($myaddress)
	{
		try	{	
			$query = "select a.messageid,a.fromuid,a.fromaddress,a.touid,a.toaddress,a.subject,a.message,"
					."a.referance,a.createdon,a.status,a.tag "
						." from  messages_t a "
							." where a.toaddress = ". quote($myaddress)
								." order by a.createdon desc";
			$this->log->userLog("Query : ".$query);
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			return $this->sqlExec->getResults();
		}
		catch(Exception $e)	{
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
	
	public function getMySentMessages($myaddress)
	{
		try	{	
			$query = "select a.messageid,a.fromuid,a.fromaddress,a.touid,a.toaddress,a.subject,a.message,"
					."a.referance,a.createdon,a.status,a.tag "
						." from  messages_t a "
							." where a.fromaddress = ". quote($myaddress)
								." order by a.createdon desc";
			$this->log->userLog("Query : ".$query);
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			return $this->sqlExec->getResults();
		}
		catch(Exception $e)	{
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
	public function getSentMessages($resultType,$toaddress,$startNo=0,$blockSize=9)
	{
		$searchStr="";
		$limit=" LIMIT $startNo, $blockSize";
		if($toaddress=='all')
			$searchStr=" and a.fromaddress = ". quote('churchteam');
		else
			$searchStr=" and a.toaddress = ". quote($toaddress);
		try	{	
			if($resultType=='DATACOUNT')
 				$query = "select count(messageid) as cnt from messages_t a, userregistration_t b where a.touid=b.uid ".$searchStr;
			else{
				$query = "select a.messageid,a.fromuid,a.fromaddress,a.touid,a.toaddress,"
				."a.subject,a.message,a.createdon,a.status,a.tag,b.uid,b.name "
							." from  messages_t a, userregistration_t b"
								." where a.touid=b.uid ".$searchStr
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
	/****************************************************
	* In Messages from the user to churchteam Admin   **
	*****************************************************/
	public function getInMessages($resultType,$fromaddress,$startNo=0,$blockSize=9)
	{
		$searchStr="";
		$limit=" LIMIT $startNo, $blockSize";

		if($fromaddress=='all')
			$searchStr=" and a.toaddress = ". quote('churchteam');
		else
			$searchStr=" and a.fromaddress = ". quote($fromaddress);
		try	{	
			if($resultType=='DATACOUNT')
 				$query = "select count(messageid) as cnt from messages_t a, userregistration_t b where a.fromuid=b.uid ".$searchStr;
			else{
				$query = "select a.messageid,a.fromuid,a.fromaddress,a.touid,a.toaddress,"
				."a.subject,a.message,a.createdon,a.status,a.tag,b.uid,b.name "
							." from  messages_t a, userregistration_t b"
								." where a.fromuid=b.uid ".$searchStr
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
	
	/****************************************************
	* Sent Messages to GUEST from churchteam Admin **
	*****************************************************/
	public function getSentMessagesOfGuest($resultType,$toaddress,$startNo=0,$blockSize=9)
	{
		$searchStr="";
		$limit=" LIMIT $startNo, $blockSize";
		if($toaddress=='all')
			$searchStr=" and a.fromaddress = ". quote('churchteam');
		else
			$searchStr=" and a.toaddress = ". quote($toaddress);
		try	{	
			if($resultType=='DATACOUNT')
 				$query = "select count(messageid) as cnt from messages_t a where a.touid=0 ".$searchStr;
			else{
				$query = "select a.messageid,a.fromuid,a.fromaddress,a.touid,a.toaddress,"
				."a.subject,a.message,a.createdon,a.status,a.tag "
							." from  messages_t a"
								." where a.touid=0 ".$searchStr
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
	/****************************************************
	* In Messages from  GUEST  to churchteam Admin   **
	*****************************************************/
	public function getInMessagesOfGuest($resultType,$fromaddress,$startNo=0,$blockSize=9)
	{
		$searchStr="";
		$limit=" LIMIT $startNo, $blockSize";

		if($fromaddress=='all')
			$searchStr=" and a.toaddress = ". quote('churchteam');
		else
			$searchStr=" and a.fromaddress = ". quote($fromaddress);
		try	{	
			if($resultType=='DATACOUNT')
 				$query = "select count(messageid) as cnt from messages_t a where a.fromuid=0 ".$searchStr;
			else{
				$query = "select a.messageid,a.fromuid,a.fromaddress,a.touid,a.toaddress,"
				."a.subject,a.message,a.createdon,a.status,a.tag"
							." from  messages_t a"
								." where a.fromuid=0 ".$searchStr
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