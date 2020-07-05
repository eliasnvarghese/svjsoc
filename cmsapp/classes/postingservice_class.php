<?php
/*
 * @Project     :  St. StephenChurch
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 14/11/2018
 */
?>
<?php
/*
* PostingService
*
*/
class PostingService
{
	private $log;
	public function __construct()
	{
		$this->log=new Logging();
	}

	//Public Mehtods Starts Here
	public function getPosting($postingId)
	{
		try	{
			$query = "select postingid,contenttype,contentid,videotype,videourl,videolabel,"
			."imagetype,imagepath,title,description,deleted,createdon,createdby "
			." from postings_t "
			." where postingid = ".$postingId;
				$this->log->debugLog("getPosting ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			$results = $this->sqlExec->getResults();
			while($row = mysqli_fetch_array($results))
			{
				$postingObj = new InstPosting();
				$postingObj->setPostingId($row["postingid"]);
				$postingObj->setContentType($row["contenttype"]);
				$postingObj->setContentId($row["contentid"]);
				$postingObj->setVideoType($row["videotype"]);
				$postingObj->setVideoUrl($row["videourl"]);
				$postingObj->setVideoLabel($row["videolabel"]);
				$postingObj->setImageType($row["imagetype"]);
				$postingObj->setImagePath($row["imagepath"]);
				$postingObj->setTitle($row["title"]);
				$postingObj->setDescription($row["description"]);
				$postingObj->setDeleted($row["deleted"]);
				$postingObj->setCreatedOn($row["createdon"]);
				$postingObj->setCreatedBy($row["createdby"]);
				return $postingObj;
			}
		}
		catch(Exception $e)
		{
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
		
	public function getPostingList($contentType)
	{
		try	{
			$query = "select postingid,contenttype,contentid,videotype,videourl,videolabel,"
			."imagetype,imagepath,title,description,deleted,createdon,createdby "
						." from postings_t "
						 ." where deleted='0' "
						 ." and contenttype=".quote($contentType)
						 ." order by createdon desc";
			$this->log->debugLog("getPostingList ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			$results = $this->sqlExec->getResults();
			return $results;
		}catch(Exception $e)	{
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return false;
	}

	public function getAllPostings($resultType,$contentType,$startNo=0,$blockSize=9) {
	 	try{
 			$searchString=" where a.deleted=0  and contenttype=".quote($contentType);
			
 			$cnt=0;
 			$limit=" LIMIT $startNo, $blockSize";
 			$orderby=" order by createdon desc";
 			if($resultType=='DATACOUNT')
 				$query = "select count(a.postingid) as cnt from postings_t a ".$searchString;
 			else
 				$query = "select a.postingid,a.contenttype,a.contentid,"
			."a.videotype,a.videourl,a.videolabel,a.imagetype,a.imagepath,a.title,a.description,"
			."a.posting_like,a.createdon,a.createdby  "
							." from postings_t a ".$searchString . $orderby . $limit;
 			$results=$this->executeQuery($query,"getAllPostings");
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
	public function addPosting($postingObj)
	{
		$stat=0;
		try{
			 $query="insert into postings_t(contenttype,contentid,"
			 ."videotype,videourl,videolabel,imagetype,imagepath,title,description,deleted,createdon,createdby)"
			."values("
			.quote($postingObj->getContentType()).","
			.quote($postingObj->getContentId()).","
			.quote($postingObj->getVideoType()).","
			.quote($postingObj->getVideoUrl()).","
			.quote($postingObj->getVideoLabel()).","
			.quote($postingObj->getImageType()).","
			.quote($postingObj->getImagePath()).","
			.quote($postingObj->getTitle()).","
			.quote($postingObj->getDescription()).","
			.quote("0").","
			.quote($postingObj->getCreatedOn()).","
			.quote($postingObj->getCreatedBy())
			.")";
			
			$this->log->debugLog("addPosting ".$query );
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))	{
				$stat=mysqli_insert_id($this->sqlExec->getConn());
			}			
		}catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return $stat;
	}	
	public function updatePosting($postingObj)
	{
		$stat=0;
		try{
			 $query="update postings_t set "
						. "contenttype="	.quote($postingObj->getContentType()).","
						. "contentid="	.quote($postingObj->getContentId()).","
						. "videotype="	.quote($postingObj->getVideoType()).","
						. "videourl="	.quote($postingObj->getVideoUrl()).","
						. "videolabel="	.quote($postingObj->getVideoLabel()).","
						. "imagetype="	.quote($postingObj->getImageType()).","
						. "imagepath="	.quote($postingObj->getImagePath()).","
						. "title="	.quote($postingObj->getTitle()).","
						. "description="	.quote($postingObj->getDescription()).","
						. "createdon="	.quote($postingObj->getCreatedOn()).","
						. "createdby="	.quote($postingObj->getCreatedBy())
							." where postingid=".quote($postingObj->getPostingId());
			
			$this->log->debugLog("updatePosting ".$query );
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))	{
				$stat=1;
			}
		}catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return $stat;
	}
	public function deletePosting($postingId){
		$stat=0;
		try{
			$query=" delete from postings_t where postingid=".quote($postingId);
			$this->log->debugLog("deletePosting :".$query);
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))
				$stat=1;
		}
		catch(Exception $e){
			throw new Exception("Error".$e->getMessage());
		}
		return $stat;	
	}

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
}
?>
