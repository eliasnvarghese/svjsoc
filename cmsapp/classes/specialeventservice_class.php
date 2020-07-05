<?php
/*
 * @Project     :  St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 4/3/2019
 */
?>
<?php
/*
* SpecialEventService
*
*/
class SpecialEventService
{
	private $log;
	public function __construct()
	{
		$this->log=new Logging();
	}
	//Public Mehtods Starts Here
	public function getCurrentEvent()
	{
		$today=date('Y-m-d');
		try{
			$query = "select eventid,eventname,eventdetails,highlights,fromdate,todate,deleted,createdon,createdby "
						." from spl_events_t "
					." where deleted=0 and fromdate<=".quote($today)." and todate>=".quote($today);
			$this->log->debugLog("getCurrentEvent ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			return $this->getEventObject($this->sqlExec->getResults());
		} catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
	public function getNextEvent()
	{
		$today=date('Y-m-d');
		try{
			$query = "select eventid,eventname,eventdetails,highlights,fromdate,todate,deleted,createdon,createdby "
						." from spl_events_t "
					." where deleted=0 and todate>=".quote($today) ." order by fromdate asc limit 1";
			$this->log->debugLog("getNextEvent ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			$this->log->debugLog("returing result from getNextEvent " );
			return $this->getEventObject($this->sqlExec->getResults());
		} catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
	public function getUpComingEvents($limit=3)
	{
		$today=date('Y-m-d');
		try{
			$query = "select eventid,eventname,eventdetails,highlights,fromdate,todate,deleted,createdon,createdby "
						." from spl_events_t "
							." where deleted=0 and todate>=".quote($today) . " order by fromdate asc ,todate asc limit ".$limit;
			$this->log->debugLog("getUpComingEvents ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			return $this->sqlExec->getResults();
		} catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
	public function getPastEvents()
	{
		$today=date('Y-m-d');
		try{
			$query = "select eventid,eventname,eventdetails,highlights,fromdate,todate,deleted,createdon,createdby "
						." from spl_events_t "
							." where deleted=0 and todate<".quote($today) . " order by fromdate asc ,todate asc";
			$this->log->debugLog("getUpComingEvents ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			return $this->sqlExec->getResults();
		} catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
	//Public Mehtods Starts Here
	public function getEvent($eventid)
	{
		try{
			$query = "select eventid,eventname,eventdetails,highlights,fromdate,todate,deleted,createdon,createdby "
						." from spl_events_t "
								." where eventid = ".$eventid;
				$this->log->debugLog("getEvent ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			$results = $this->sqlExec->getResults();
			while($row = mysqli_fetch_array($results))
			{
				$eventObj = new Event();
				$eventObj->setEventId($row["eventid"]);
				$eventObj->setEventName($row["eventname"]);
				$eventObj->setHighlights($row["highlights"]);
				$eventObj->setEventDetails($row["eventdetails"]);
				$eventObj->setFromDate($row["fromdate"]);
				$eventObj->setToDate($row["todate"]);
				$eventObj->setDeleted($row["deleted"]);
				$eventObj->setCreatedOn($row["createdon"]);
				$eventObj->setCreatedBy($row["createdby"]);
				return $eventObj;
			}
		} catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
		
	public function isEventExists($eventId,$fromdate,$todate) {
		$fromdate=convertFromUserDateToYmd($fromdate);
		$todate=convertFromUserDateToYmd($todate);
	 	$cnt=0;
		try{
 			$query = "select count(eventid) as cnt from spl_events_t where deleted = 0 and eventid!= ".$eventId
						. " and ("
						. "( fromdate<=".quote($fromdate)." and todate>=".quote($todate) .") or "
						. "( fromdate>=".quote($fromdate)." and todate<=".quote($todate) .") or "
						. "( fromdate>=".quote($fromdate)." and todate<=".quote($fromdate) .") or "
						. "( fromdate>=".quote($todate)." and todate<=".quote($todate) .") or "
						. "( ".quote($fromdate)." >= fromdate and ".quote($fromdate) ."<= todate ) or "
						. "( ".quote($todate)." >= fromdate and ".quote($todate) ."<= todate )  "
							.")"; 			
			
 			$results=$this->executeQuery($query,"isEventExists");
			while($row=mysqli_fetch_array($results)){ 
				$cnt=$row['cnt'];
			}
			if($cnt>0)
				return true;
 		}
 		catch(Exception $e) {
 			throw new Exception("Cannot get isEventExists..".$e->getMessage());
 		}
		return false;
 	}	
	public function isEventIdExists($eventId) {
	 	$cnt=0;
		try{
 			$query = "select count(eventid) as cnt from spl_events_t where deleted = 0 and eventid= ".$eventId;
			
 			$results=$this->executeQuery($query,"isEventIdExists");
			while($row=mysqli_fetch_array($results)){ 
				$cnt=$row['cnt'];
			}
			if($cnt>0)
				return true;
 		}
 		catch(Exception $e) {
 			throw new Exception("Cannot get isEventIdExists..".$e->getMessage());
 		}
		return false;
 	}	
	public function getAllTopEventList() {
		$selectString="eventid,eventname,eventdetails,highlights,fromdate,todate,deleted,createdon,createdby";
	 	try{
 			$limit=" LIMIT 0,100";
 			$orderby=" order by fromdate asc";
 			$query = "select ".$selectString ." from spl_events_t where deleted = 0 " . $orderby . $limit;
 			$results=$this->executeQuery($query,"getAllTopEventList");
 			return $results;
 		}
 		catch(Exception $e) {
 			throw new Exception("Cannot get getAllUniversitysList..".$e->getMessage());
 		}
 	}
	
	public function getEventList($resultType,$search_str="",$startNo=0,$blockSize=9) {
		$selectString="eventid,eventname,eventdetails,highlights,fromdate,todate,deleted,createdon,createdby";
	 		try{
 			$searchString=" deleted = 0 ";
			if($search_str!="" && $searchString!="")
				$searchString .= " and eventname like ".quote('%'.$search_str.'%');
			if($searchString!="")
				$searchString = " where ".$searchString;

 			$cnt=0;
 			$limit=" LIMIT $startNo, $blockSize";
 			$orderby=" order by fromdate,todate";
 			if($resultType=='DATACOUNT')
 				$query = "select count(eventid) as cnt from spl_events_t  ".$searchString;
 			else
 				$query = "select ".$selectString ." from spl_events_t ".$searchString . $orderby . $limit;
 			$results=$this->executeQuery($query,"getEventList");
 			if($resultType=='DATACOUNT'){
 				while($row=mysqli_fetch_array($results)){ 
 					$cnt=$row['cnt'];
 				}
 				return $cnt;
 			}
 			return $results;
 		}
 		catch(Exception $e) {
 			throw new Exception("Cannot get getAllUniversitysList..".$e->getMessage());
 		}
 	}

	public function addEvent($eventObj){
		$stat=0;
		try{
			 $query="insert into spl_events_t"
						."(eventname,eventdetails,highlights,fromdate,todate,deleted,createdon,createdby)"
							."values("
								.quote($eventObj->getEventName()).","
								.quote($eventObj->getEventDetails()).","
								.quote($eventObj->getHighlights()).","
								.quote(convertFromUserDateToYmd($eventObj->getFromDate())).","
								.quote(convertFromUserDateToYmd($eventObj->getToDate())).","
								.quote("0").","
								.quote($eventObj->getCreatedOn()).","
								.quote($eventObj->getCreatedBy())
							.")";
			
			$this->log->debugLog("addEvent ".$query );
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query)){
				$stat=mysqli_insert_id($this->sqlExec->getConn());
			}
		}catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return $stat;
	}	
	public function updEvent($eventObj)
	{
		$stat=0;
		try{
			 $query="update spl_events_t"
				." set "
					."eventname=".quote($eventObj->getEventName()).","
					."eventdetails=".quote($eventObj->getEventDetails()).","
					."highlights=".quote($eventObj->getHighlights()).","
					."fromdate=".quote(convertFromUserDateToYmd($eventObj->getFromDate())).","
					."todate=".	quote(convertFromUserDateToYmd($eventObj->getToDate())).","
					."createdon=".quote($eventObj->getCreatedOn()).","
					."createdby =".quote($eventObj->getCreatedBy())
						." where eventid = ".$eventObj->getEventId();
			
			$this->log->debugLog("updEvent ".$query );
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query)){
				$stat=1;
			}
		}catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return $stat;
	}	
	public function deleteEvent($eventid)
	{
		$stat=0;
		try{
			 $query="update spl_events_t set deleted = 1  where eventid = ".quote($eventid);
			
			$this->log->debugLog("deleteEvent ".$query );
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query)){
				$stat=1;
			}
		}catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return $stat;
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
