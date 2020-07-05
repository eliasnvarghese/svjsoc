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
* ContentManagementService
*
*/
class ContentManagementService
{
	private $log;
	public function __construct()
	{
		$this->log=new Logging();
	}
	
	public function getGospel($gospelid){
		$query = "select gospelid,gospel,bookof,deleted,createdon,createdby from gospel_t where gospelid=".$gospelid ;
		$results= $this->executeQuery($query,"getAllGospels"); 
		return $results;
	}	
	public function getAllGospels(){
		$query = "select gospelid,gospel,bookof,deleted,createdon,createdby from gospel_t where deleted=0" ;
		$results= $this->executeQuery($query,"getAllGospels"); 
		return $results;
	}	

	public function addGospel($gospel,$bookof){
		$query = "insert into gospel_t (gospel,bookof) values(".quote($gospel).",".quote($bookof).")" ;
		$stat=$this->executeInsert($query,"addGospel ");
		return $stat;
	}	
	public function updateGospel($gospelid,$gospel,$bookof){
		$query = "update gospel_t set gospel = ".quote($gospel).", bookof=".quote($bookof)." where gospelid=".$gospelid ;
		$stat=$this->executeUpdate($query,"updateGospel ");
		return $stat;
	}		
	public function deleteGospel($gospelid){
		$query = "update gospel_t set deleted=1 where gospelid=".$gospelid ;
		$stat=$this->executeUpdate($query,"deleteGospel ");
		return $stat;
	}	

	//Public Mehtods Starts Here
	public function getImage($imageId)
	{
		try	{
			$query = "select imageid, inst_id, imagetype, filename, title, description, deleted, createdon, createdby "
			." from inst_galleryimages_t "
			." where imageid = ".$imageId;
			$results = $this->executeQuery($query);
		
			while($row = mysqli_fetch_array($results)){
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
		catch(Exception $e)	{
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
						 
			$results = $this->executeQuery($query);
			return $results;
		}catch(Exception $e){
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
			$stat=$this->executeInsert($query,"addGallery ");
		
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
			
				$stat=$this->executeUpdate($query,"addGallery ");
		}catch(Exception $e){
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return $stat;
	}
	public function deleteGallery($imageId){
		$stat=0;
		try{
			$query=" delete from inst_galleryimages_t where imageid=".quote($imageId);
			$stat=$this->executeUpdate($query,"deleteGallery ");
		}
		catch(Exception $e){
			throw new Exception("Error".$e->getMessage());
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
