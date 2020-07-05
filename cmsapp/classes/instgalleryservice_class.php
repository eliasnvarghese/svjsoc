<?php
/*
 * @Project     :  St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 */
?>
<?php
/*
* InstGalleryService
*
*/
class InstGalleryService
{
	private $log;
	public function __construct()
	{
		$this->log=new Logging();
	}

	//Public Mehtods Starts Here
	public function getImage($imageId)
	{
		try	{
			$query = "select imageid, inst_id, imagetype, filename, title, description, deleted, createdon, createdby "
			." from inst_galleryimages_t "
			." where imageid = ".$imageId;
				$this->log->debugLog("getPosting ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			$results = $this->sqlExec->getResults();
			while($row = mysqli_fetch_array($results))
			{
				$galleryObj = new InstGallery();
				$galleryObj->setImageId($row["imageid"]);
				$galleryObj->setInst_Id($row["inst_id"]);
				$galleryObj->setImageType($row["imagetype"]);
				$galleryObj->setFileName($row["filename"]);
				$galleryObj->setTitle($row["title"]);
				$galleryObj->setDescription($row["description"]);
				$galleryObj->setDeleted($row["deleted"]);
				$galleryObj->setCreatedOn($row["createdon"]);
				$galleryObj->setCreatedBy($row["createdby"]);
				return $galleryObj;
			}
		}
		catch(Exception $e)
		{
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
		
	public function getImageList($inst_Id)
	{
		try	{
			$query = "select imageid, inst_id, imagetype, filename, title, description, deleted, createdon, createdby "
						." from inst_galleryimages_t "
						 ." where inst_id =".$inst_Id." and deleted='0' "
						 ." order by createdon desc";
						 
			$this->log->debugLog("getImageList ".$query );
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			$results = $this->sqlExec->getResults();
			return $results;
		}catch(Exception $e)	{
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return false;
	}

	public function getAllImages($resultType,$country_code="",$search_str="",$startNo=0,$blockSize=9) {
	 	try{
 			$searchString=" where a.inst_id=b.inst_id ";
			if($country_code!="all")
				$searchString .=" and b.country_code = ".quote($country_code) ;
			if($search_str!="")
				$searchString .= " and b.inst_name like ".quote('%'.$search_str.'%');
			
 			$cnt=0;
 			$limit=" LIMIT $startNo, $blockSize";
 			$orderby=" order by b.country_code,b.inst_name";
 			if($resultType=='DATACOUNT')
 				$query = "select count(a.imageid) as cnt from inst_galleryimages_t a, institution_t b ".$searchString;
 			else
 				$query = "select a.imageid,a.inst_id, b.inst_name,b.country_code,b.country, "
							."a.imagetype, a.filename, a.title, a.description, a.deleted,"
							."a.createdon,a.createdby  "
								." from inst_galleryimages_t a, institution_t b ".$searchString . $orderby . $limit;
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
 			throw new Exception("Cannot get getAllImages..".$e->getMessage());
 		}
 	}
	public function addGallery($galleryObj)
	{
		try{
			 $query="insert into inst_galleryimages_t(inst_id, imagetype, filename, title, description, deleted, createdon, createdby)"
			."values("
			.$galleryObj->getInst_Id().","
			.quote($galleryObj->getImageType()).","
			.quote($galleryObj->getFileName()).","
			.quote($galleryObj->getTitle()).","
			.quote($galleryObj->getDescription()).","
			.quote("0").","
			.quote($galleryObj->getCreatedOn()).","
			.quote($galleryObj->getCreatedBy())
			.")";
			
			$this->log->debugLog("addGallery ".$query );
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))	{
				$stat=mysqli_insert_id($this->sqlExec->getConn());
			}
			else
				$stat=0;
		}catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return $stat;
	}	
	public function updateGallery($galleryObj)
	{
		try{
			 $query="update inst_galleryimages_t set "
						. "inst_id="	.$galleryObj->getInst_Id().","
						. "imagetype="	.quote($galleryObj->getImageType()).","
						. "filename="	.quote($galleryObj->getFileName()).","
						. "title="	.quote($galleryObj->getTitle()).","
						. "description="	.quote($galleryObj->getDescription()).","
						. "createdon="	.quote($galleryObj->getCreatedOn()).","
						. "createdby="	.quote($galleryObj->getCreatedBy())
							." where imageid=".quote($galleryObj->getImageId());
			
			$this->log->debugLog("updateGallery ".$query );
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))	{
				$stat=1;
			}
			else
				$stat=0;
		}catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return $stat;
	}
	public function deleteGallery($imageId){
		$stat=0;
		try{
			$query=" delete from inst_galleryimages_t where imageid=".quote($imageId);
			$this->log->debugLog("deleteGallery :".$query);
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
