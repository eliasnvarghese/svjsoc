<?php
/****************************************
 * @Project     : St Stephen Church 
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php
/*
* UserService
*
*/
class AdminUserService
{
	private $log;

	public function __construct() {
		$this->log=new Logging();
	}

	public function isUserExists($userId) {
		try {
			$query = "select userid from admin_user_details_t  where userid= ".quote($userId);
			 $results=$this->executeQuery($query,"isUserIdExists");
			while($row = mysqli_fetch_array($results)) {
				if($row["userid"]!="")
					return true;
			}
			return false;
		}
		catch(Exception $e) {
			throw new Exception("Error while checking user existence..".$e->getMessage());
		}
	}

	public function adminAuthenticate($userId,$passwd) {
		$userId=str_replace(" ","",$userId);
		$passwd=str_replace(" ","",$passwd);

		$query = "select a.uid,a.userid,a.username,a.firstname,a.lastname,a.passwd,a.saltkey,a.sessionid,"
					." a.activated,a.activationdata,a.activatedon,a.photopath "
					." from admin_user_details_t a "
         			 ." where a.userid =".quote($userId)."  limit 1";
		 $results=$this->executeQuery($query,"adminAuthenticate");
		while($row = mysqli_fetch_array($results)){
			$this->log->debugLog("got data...".encrypt($passwd,$row["saltkey"]));
			$found=false;
			if($row["saltkey"]==""){
				if($passwd==$row["passwd"]){
					$this->log->debugLog("pasword matching true");
					$found=true;
				}
			}
			else if(encrypt($passwd,$row["saltkey"])==$row["passwd"]){
				$this->log->debugLog("encrypted pass true");
				$found=true;
			}
			$this->log->debugLog("Authenticate ====".$found);
			if($found==true){	
				$userData=new AdminUserData();
				$m_FullName=trim($row["firstname"]).rtrim(" ".$row["lastname"]);
				$m_SessionId=session_id();
				$m_Activated=$row["activated"];
				$uId=$row["uid"];
				$userData->setUserName($row["username"]);
				$userData->setUserDataData($uId,$row["userid"],$m_SessionId,$m_FullName,$m_Activated);
				$userData->setPhotoPath($row["photopath"]);
				return $userData;
			}
		}
		return null;
	}
	
	public function adminReAuthenticate($userId) {
		$userId=str_replace(" ","",$userId);

		$query = "select a.uid,a.userid,a.username,a.firstname,a.lastname,a.passwd,a.saltkey,a.sessionid,"
					." a.activated,a.activationdata,a.activatedon,a.photopath "
					." from admin_user_details_t a  where a.userid =".quote($userId)."  limit 1";
		 $results=$this->executeQuery($query,"adminAuthenticate");
		while($row = mysqli_fetch_array($results)){
			//$this->log->debugLog("got data...".encrypt($passwd,$row["saltkey"]));
			$found=true;
			if($found==true){	
				$userData=new AdminUserData();
				$m_FullName=trim($row["firstname"]).rtrim(" ".$row["lastname"]);
				$m_SessionId=session_id();
				$m_Activated=$row["activated"];
				$uId=$row["uid"];
				$userData->setUserName($row["username"]);
				$userData->setUserDataData($uId,$row["userid"],$m_SessionId,$m_FullName,$m_Activated);
				$userData->setPhotoPath($row["photopath"]);
				return $userData;
			}
		}
		return null;
	}
		
	public function changePassword($userId,$oldPasswd,$newPasswd) {
		try {
			
			$saltKey=$this->generateSaltKey($userId);
			$query="update admin_user_details_t set passwd = ".quote(encrypt($newPasswd,$saltKey)) ." , saltkey= ".quote($saltKey)
				." where userid=".quote($userId)." and passwd=".quote($oldPasswd);			
				
			return $this->executeUpdate($query,"changePassword");
		}
		catch(Exception $e) {
			throw new Exception("Cannot Change the Password..".$e->getMessage());
		}
	}
	public function resetPassword($userId,$newPasswd) {
		try {
			
				$saltKey=$this->generateSaltKey($userId);
				$query="update admin_user_details_t set passwd = ".quote(encrypt($newPasswd,$saltKey)) ." , saltkey= ".quote($saltKey)
					." where userid=".quote($userId);
			
			return $this->executeUpdate($query,"resetPassword");
		}
		catch(Exception $e) {
			throw new Exception("Cannot reset the Password..".$e->getMessage());
		}
	}
	
	public function addUser($userAccount){
		$saltKey=$this->generateSaltKey($userAccount->getUserId());
		try{
			$query="insert into admin_user_details_t(userid,passwd,saltkey,activated,activatedon,firstname,lastname,gender,"
			."organizationname,designation,address,city,state,country,zipcode,dob,contactnumber,mobilenumber,securityquestion,securityanswer,altemailid,"
			."photopath,themeid,createdby)"
			."values("
			.quote($userAccount->getUserId()).","
			.quote(encrypt($userAccount->getPasswd(),$saltKey)).","
			.quote($saltKey).","
			.$userAccount->getActivated().","
			.quote($userAccount->getActivatedOn()).","
			.quote($userAccount->getFirstName()).","
			.quote($userAccount->getLastName()).","
			.quote($userAccount->getGender()).","
			.quote($userAccount->getOrganizationName()).","
			.quote($userAccount->getDesignation()).","
			.quote($userAccount->getAddress()).","
			.quote($userAccount->getCity()).","
			.quote($userAccount->getState()).","
			.quote($userAccount->getCountry()).","
			.quote($userAccount->getZipcode()).","
			.quote($userAccount->getDob()).","
			.quote($userAccount->getContactNumber()).","
			.quote($userAccount->getMobileNumber()).","
			.quote($userAccount->getSecurityQuestion()).","
			.quote($userAccount->getSecurityAnswer()).","
			.quote($userAccount->getAltEmailId()).","
			.quote($userAccount->getPhotoPath()).","
			.quote($userAccount->getThemeId()).","
			.quote($userAccount->getCreatedBy())
			.")";

			$this->log->userLog("add admin user-- : ".$query);
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))	{
				$stat=mysqli_insert_id($this->sqlExec->getConn());
			}
			else{
				$stat=0;
				$this->log->userLog("User Account Save failed...".$userAccount->getUserId());
			}
		}catch(Exception $e){
			$stat=0;
			$this->log->userLog("User Account Save failed...".$userAccount->getUserId());
		}
	
		return $stat;
	}
	
	public function getUserByUserId($userId){
		return $this->getUser("userid=".quote($userId));
	}
	public function getUserByUid($uid){
		return $this->getUser("uid=".quote($uid));
	}
	private function getUser($searchId){
		$query = "select uid,userid ,username ,firstname ,lastname ,gender ,passwd ,saltkey ,sessionid ,activationdata ,activated ,"
			."activatedon ,organizationname ,designation ,address ,city ,state ,country ,zipcode ,dob ,contactnumber ,mobilenumber ,"
			."securityquestion ,securityanswer ,altemailid ,photopath ,imagetype ,coverphoto ,tagline ,aboutme ,themeid ,profilesecurity ,"
			."community ,country_code ,region_code ,longitude ,latitude ,timezone ,createdon ,createdby "
			." from admin_user_details_t  where ".$searchId;
		$results= $this->executeQuery($query,"getUserByUid");
		while($row = mysqli_fetch_array($results)){	
			$userAccount=new AdminUserAccount();
			$userAccount->setUId($row["uid"]);
			$userAccount->setUserId($row["userid"]);
			$userAccount->setActivated($row["activated"]);
			$userAccount->setActivatedOn($row["activatedon"]);
			$userAccount->setFirstName($row["firstname"]);
			$userAccount->setLastName($row["lastname"]);
			$userAccount->setGender($row["gender"]);
			$userAccount->setSaltKey($row["saltkey"]);
			$userAccount->setPasswd($row["passwd"]);
			$userAccount->setOrganizationName($row["organizationname"]);
			$userAccount->setDesignation($row["designation"]);
			$userAccount->setAddress($row["address"]);
			$userAccount->setCity($row["city"]);
			$userAccount->setState($row["state"]);
			$userAccount->setCountry($row["country"]);
			$userAccount->setZipcode($row["zipcode"]);
			$userAccount->setDob($row["dob"]);
			$userAccount->setContactNumber($row["contactnumber"]);
			$userAccount->setMobileNumber($row["mobilenumber"]);
			$userAccount->setSecurityQuestion($row["securityquestion"]);
			$userAccount->setSecurityAnswer($row["securityanswer"]);
			$userAccount->setAltEmailId($row["altemailid"]);
			$userAccount->setPhotoPath($row["photopath"]);
			$userAccount->setThemeId($row["themeid"]);
			$userAccount->setCreatedOn($row["createdon"]);
			$userAccount->setCreatedBy($row["createdby"]);
			return $userAccount;
		}
		return null;
	}
	//Public Mehtods Starts Here
	
	public function getAllUsers($resultType,$searchStr="",$startNo=0,$blockSize=15) {
		try{
			
			$searchString=($searchStr!="")? "  firstname like ".quote("%".$searchStr."%") : "";
			if($searchString!="")
				$searchString=" where ".$searchString;
			if($resultType=="DATACOUNT"){
				$data_count=0;
				$query = "select count(uid) as cnt from admin_user_details_t  ".$searchString;
				$results=$this->executeQuery($query,"getAllUsers");
				while($row = mysqli_fetch_array($results)){	
					$data_count=$row["cnt"];
					break;
				}
				return $data_count;
			}
			else{
				$limit=$startNo.",".$blockSize;
				$query = "select uid ,userid ,username ,firstname ,lastname ,gender ,passwd ,saltkey ,sessionid ,activationdata ,activated ,"
						."activatedon ,organizationname ,designation ,address ,city ,state ,country ,zipcode ,dob ,contactnumber ,mobilenumber ,"
						."securityquestion ,securityanswer ,altemailid ,photopath ,imagetype ,coverphoto ,tagline ,aboutme ,themeid ,profilesecurity ,"
						."community ,country_code ,region_code ,longitude ,latitude ,timezone ,createdon ,createdby "
						." from admin_user_details_t  ".$searchString." limit ".$limit;
					return $this->executeQuery($query,"getAllUsers");
			}
		}
		catch(Exception $e) {
			throw new Exception("Cannot get getAllUsers..".$e->getMessage());
		}
	}
	//delete user by admin 
	public function deleteUser($uid){
		try{
			$stat=0;
			$query=" update admin_user_details_t set activated = 2 where userid=".quote($uid);
			$this->log->debugLog("deleteUser :".$query);
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))
				$stat=1;
			return $stat;	
		}
		catch(Exception $e){
			throw new Exception("Error".$e->getMessage());
		}
	
	}
	public function updateUser($userAccount){
		try{
			$stat=0;
			$query="update admin_user_details_t" 
			. " set userid= ".quote($userAccount->getUserId()) .","
			. "firstname= ".quote($userAccount->getFirstName()) .","			
			."city = ".quote($userAccount->getCity()).","
			."photopath = ".quote($userAccount->getPhotoPath()).","
			."mobilenumber = ".quote($userAccount->getMobileNumber())			
			." where uid=".quote($userAccount->getUId());
			$this->log->debugLog("UpdateUser :".$query);
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))
				$stat=1;
			return $stat;	
		}
		catch(Exception $e){
			throw new Exception("Error".$e->getMessage());
		}
	
	}
	
	public function generateActivationKey($userId){
		return encrypt($userId.date('Y-m-d H:i:s'),"ActivationDataKey".date('Y-m-d H:i:s'));
	}
	
	public function getNewRandomPassword() {
		return encrypt(date('Y-m-d H:i:s'),"StStephenChurch_engine");
	}
	public static function generateSaltKey($userId) {
		return encrypt($userId.date('Y-m-d H:i:s'),"StStephenChurch_engine");
	}
	
	private function getUserDataObj($query) {
		$results=$this->executeQuery($query,"getUserDataObj");
		while($row = mysqli_fetch_array($results)) {
			$userData=new AdminUserData();
			$m_Name=trim($row["firstname"]).rtrim(" ".$row["lastname"]);
			$m_SessionId=session_id();
			$userData->setUId($row["uid"]);
			$userData->setUserId($row["userid"]);
			$userData->setUserName($row["username"]);
			$userData->setName($m_Name);
			$userData->setSessionId($m_SessionId);
			$userData->setActivated($row["activated"]);
			$userData->setActivationData($row["activationdata"]);
			$userData->setActivatedOn($row["activatedon"]);
			$userData->setPhotoPath($row["photopath"]);
			return $userData;
		}
		return null;
	}

	public function addLoginActivity($userId,$sessionId) {
		$this->removeAllLoginActivity($userId);
		$ipaddress=$_SERVER["REMOTE_ADDR"];
		$hashkey= md5($userId);
		$query="insert into admin_loginactivity(userid,logintime,lastupdate,ipaddress,hashkey,sessionid)"
		."values("
			.quote($userId).","
			.quote(date("Y-m-d H:i:s")).","
			.quote(date("Y-m-d H:i:s")).","
			.quote($ipaddress).","
			.quote($hashkey).","
			.quote($sessionId)
		.")";
		return $this->executeInsert($query,"addLoginActivity");
	}
	
	public function checkUserVerification($userId,$sessionId) {
		$this->removeUnUsedLoginActivity();
		try {
			$query="update admin_loginactivity set "
			." lastupdate=".quote(date('Y-m-d H:i:s'))
			." where userid=".quote($userId)
			." and sessionid=".quote($sessionId);
			$this->log->debugLog("checkUserVerification : ".$query);
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query))
				return 1;
		}
		catch(Exception $e) {
			throw new Exception("Cannot Activate User..".$e->getMessage());
		}
		return 0;
	}
	
	public function removeUnUsedLoginActivity() {
		$query="delete  from admin_loginactivity where lastupdate<=".quote(date('Y-m-d H:i:s', strtotime("-1 days")));
		$n=$this->executeUpdate($query,"removeUnUsedLoginActivity");
	}
	
	public function removeAllLoginActivity($userId) {
		$query="delete  from admin_loginactivity where userid=".quote($userId) ;
		$n=$this->executeUpdate($query,"removeAllLoginActivity");
	}
	public function removeLoginActivity($userId,$sessionId) {
		$query="delete  from admin_loginactivity where userid=".quote($userId) ." and sessionid=".quote($sessionId);
		$n=$this->executeUpdate($query,"removeLoginActivity");
	}
	public function getLoginActivity($ip) {
		$query="select  userid,ipaddress,hashkey from admin_loginactivity where ipaddress=".quote($ip);
		return $this->executeQuery($query,"getLoginActivity");
	}

	public function addUserActivity($userId,$activity) {
		$query="insert into admin_useractivity(client_id,activityperformed,hostname,createdby)"
		."values("
			.quote($_SESSION['edp_userData_ClientId']).","
			.quote($activity).","
			.quote($_SERVER["REMOTE_ADDR"]).","
			.quote($userId)
		.")";
		return $this->executeInsert($query,"addUserActivity");
	}
public function getUserActivityByPeriod($fromDate,$toDate,$category="")
	{
		$subqry="";
		if(trim($category!=""))
			$subqry=" and category=".quote($category);	
		try{
			$toDate=date('Y-m-d', strtotime($toDate. ' + 1 days'));
			$query = "select a.uid,a.userid,a.firstname,a.lastname,a.gender,a.designation,a.mobilenumber,a.photopath,"
					."b.activityperformed,b.hostname,b.category,b.createdon,b.createdby "
						." from admin_user_details_t a, useractivity_t b"
					." where a.userid = b.createdby ".$subqry." and b.createdon >=".quote($fromDate). " and b.createdon <=".quote($toDate)
						." order by b.createdon desc limit 100";
			$this->log->debugLog("Query : ".$query);
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			return $this->sqlExec->getResults();
		}
		catch(Exception $e)	{
			throw new Exception("Errrrr..".$e->getMessage());
		}
		return null;
	}
	private function executeQuery($query,$agent=""){
		try{
			$this->log->debugLog($agent.": ".$query);
			$this->sqlExec = new SqlExecution();
			$this->sqlExec->executeQuery($query);
			return $this->sqlExec->getResults();
		}
		catch(Exception $e) {
			$this->log->debugLog("Error while query execute..".$e->getMessage());
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
