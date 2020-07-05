<?php
/****************************************
 * @Project     : ststephenchurch 
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 06/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php
/*
* UserService
*
*/
class RegUserService
{
	private $log;
	private $basicDataString="b.uid ,b.userid ,b.name ,b.familyname,b.gender ,b.dob ,b.maritalstatus,b.spousename,b.qualification ,b.fulladdress ,
							b.zipcode ,b.city ,b.state ,b.mobilenumber ,b.phonenumber ,b.email ,b.photopath ,
							b.aboutme ,b.aboutfamily ,b.completedstage ,b.lastlogintime ,b.deleted ,b.createdon ,b.createdby ";
							
	public function __construct() {
		$this->log=new Logging();
	}
	public function isUserExists($userId) {
		try {
			$query = "select userid from useraccount_t  where userid= ".quote($userId);
			 $results=$this->executeQuery($query,"isUserExists");
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
	public function authenticate($userId,$passwd) {
		$userId=str_replace(" ","",$userId);
		$passwd=str_replace(" ","",$passwd);

		$query = "select a.uid,a.userid,a.passwd,a.saltkey,a.sessionid,"
					." a.activated,a.activationdata,a.activatedon,".$this->basicDataString
					." from useraccount_t a,userregistration_t b "
         			 ." where a.userid =".quote($userId)." and  a.uid=b.uid and b.deleted=0 limit 1";
		 $results=$this->executeQuery($query,"authenticate");
		while($row = mysqli_fetch_array($results)){
			$this->log->debugLog("Pass : ".encrypt($passwd,$row["saltkey"])."==".$row["passwd"]);
			$found=false;
			if($row["saltkey"]==""){
				if($passwd==$row["passwd"])
					$found=true;
			}
			else if(encrypt($passwd,$row["saltkey"])==$row["passwd"]){
				$found=true;
			}
			if($found==true){	
				$userData=new RegUserData();
				$m_FullName=trim($row["name"]);
				$m_SessionId=session_id();
				$m_Activated=$row["activated"];
				$uId=$row["uid"];
				$userData->setUserDataData($uId,$row["userid"],$m_SessionId,$m_FullName,$m_Activated);
				$userData->setPhotoPath($row["photopath"]);
				$userData->setGender($row["gender"]);
				$userData->setMobileNumber($row["mobilenumber"]);
				$userData->setDOB($row["dob"]);
				return $userData;
			}
		}
		return null;
	}
	public function getUserIdByUId($uId){
		try{
			$query="select a.userid,b.userid from userregistration_t b,useraccount_t a "
			." where a.uid=b.uid and b.deleted=0 and a.uid=".quote($uId);
			$results=$this->executeQuery($query,"getUserIdByUId");
			while($row = mysqli_fetch_array($results)) {
				return $row["userid"];
			}
		}
		catch(Exception $e) {
			throw new Exception("Error while checking user existence..".$e->getMessage());
		}
	}
	
	public function getUserDataByUserId($userId) {
		$userId=str_replace(" ","",$userId);
		$query = "select a.uid,a.userid,a.passwd,a.saltkey,a.sessionid,"
					." a.activated,a.activationdata,a.activatedon,".$this->basicDataString
					." from useraccount_t a,userregistration_t b "
         			 ." where a.userid =".quote($userId)." and  a.uid=b.uid and b.deleted=0 limit 1";
		 $results=$this->executeQuery($query,"getUserDataByUserId");
		while($row = mysqli_fetch_array($results)){
			$userData=new UserData();
			$m_FullName=trim($row["name"]);
			$m_SessionId=session_id();
			$m_Activated=$row["activated"];
			$uId=$row["uid"];
			$userData->setUserDataData($uId,$row["userid"],$m_SessionId,$m_FullName,$m_Activated);
			$userData->setActivationData($row["activationdata"]);
			$userData->setPhotoPath($row["photopath"]);
			$userData->setGender($row["gender"]);
			$userData->setDOB($row["dob"]);
			$userData->setCity($row["nativecity"]);
			$userData->setState($row["nativeplace"]);
			$userData->setCompletedStage($row["completedstage"]);
			return $userData;
		}
		return null;
	}	
	public function changePassword($userId,$oldPasswd,$saltKey,$newPasswd) {
		try {
			if($saltKey==""){
				$saltKey=$this->generateSaltKey("StStephenChurch");
				$query="update useraccount_t set passwd = ".quote(encrypt($newPasswd,$saltKey)) ." , saltkey= ".quote($saltKey)
					." where userid=".quote($userId)." and passwd=".quote($oldPasswd);
			}
			else{
				$query="update useraccount_t set passwd = ".quote(encrypt($newPasswd,$saltKey))
					." where userid=".quote($userId) ." and passwd=".quote(encrypt($oldPasswd,$saltKey));
			}
			return $this->executeUpdate($query,"changePassword");
		}
		catch(Exception $e) {
			throw new Exception("Cannot Change the Password..".$e->getMessage());
		}
	}

	public function sendActivationLink($userId) {

		$useraccount=NULL;
		try {
			$query = "select userid,activationdata from useraccount_t  where userid= ".$userId;
			$results=$this->executeQuery($query,"authenticate");
			while($row = mysqli_fetch_array($results)) {
				$useraccount = new UserAccount();
				$useraccount->setUId($row["uid"]);
				$useraccount->setUserId($row["userid"]);
				$useraccount->setActivationData($row["activationdata"]);
				return $useraccount;
			}
			return $useraccount;
		}
		catch(Exception $e) {
			throw new Exception("Cannot get activation data..".$e->getMessage());
		}
	}

	public function activate($userId,$activationData) {
		try{
				$stat=0;
				$query =" update useraccount_t set activated=1, "
								." activationdata=".quote($this->generateActivationKey($userId))
									." where userid= ".quote($userId)
									." and (activationdata = ".quote(str_replace(' ','+',$activationData))
									." or substring(activationdata,1,5) = ".quote(str_replace(' ','+',$activationData)).")";
			 return $this->executeUpdate($query,"activate");
		}
		catch(Exception $e){
			throw new Exception(" Cannot activate user account..".$e->getMessage());
		}
	}
	
	public function resetPassword($userId,$newPasswd) {
		try {
			$stat=0;
			$this->log->debugLog("resetPassword 1 : ".$userId.$newPasswd);
			$saltKey=$this->generateSaltKey("StStephenChurch");
			$query="update useraccount_t set passwd = ".quote(encrypt($newPasswd,$saltKey)) ." , saltkey= ".quote($saltKey) 
									." where userid= ".quote($userId) ;
			return $this->executeUpdate($query,"resetPassword");
		}
		catch(Exception $e) {
			throw new Exception(" Cannot change the password..".$e->getMessage());
		}
	}
	
	//Public Mehtods Starts Here
	public function addUser($userAccount) {
		$stat="";
		$saltKey=$this->generateSaltKey("StStephenChurch");
		$query="insert into useraccount_t(userid,passwd,saltkey,sessionid,activationdata,activated,activatedon,createdby)"
		."values("
			.quote($userAccount->getUserId()).","
			.quote(encrypt($userAccount->getPasswd(),$saltKey)).","
			.quote($saltKey).","
			.quote(session_id()).","
			.quote($userAccount->getActivationData()).","
			.$userAccount->getActivated().","
			.quote($userAccount->getActivatedOn()).","
			.quote($userAccount->getCreatedBy())
		.")";
		$this->log->userLog("Query : ".$query);

		$this->sqlExec = new SqlExecution();
		if($this->sqlExec->execute($query)) {
			$UId=mysqli_insert_id($this->sqlExec->getConn());
			$userAccount->setUId($UId);
			try{
				$query="insert into userregistration_t(uid,userid,name ,familyname,gender ,dob ,maritalstatus,spousename,qualification ,"
				."fulladdress ,zipcode ,city ,state ,mobilenumber ,phonenumber ,email ,photopath ,aboutme ,aboutfamily ,completedstage,"
				."createdon )"
				."values("
				.$userAccount->getUId().","
				.quote($userAccount->getUserId()).","
				.quote($userAccount->getName()).","
				.quote($userAccount->getFamilyName()).","
				.quote($userAccount->getGender()).","
				.quote($userAccount->getDOB()).","
				.quote($userAccount->getMaritalStatus()).","
				.quote($userAccount->getSpouseName()).","
				.quote($userAccount->getQualification()).","
				.quote($userAccount->getFullAddress()).","
				.quote($userAccount->getZipCode()).","
				.quote($userAccount->getCity()).","
				.quote($userAccount->getState()).","
				.quote($userAccount->getMobileNumber()).","
				.quote($userAccount->getPhoneNumber()).","
				.quote($userAccount->getEmail()).","
				.quote($userAccount->getPhotoPath()).","
				.quote($userAccount->getAboutMe()).","
				.quote($userAccount->getAboutFamily()).","
				.quote($userAccount->getCompletedStage()).","
				.quote($userAccount->getCreatedOn())
				.")";

				$this->log->debugLog("add user-- : ".$query);
				$this->sqlExec = new SqlExecution();
				if($this->sqlExec->execute($query))	{
					$stat=$userAccount->getUId();
					$this->log->debugLog("User Registration Save. success..".$userAccount->getUserId());
				}
				else{
					$this->log->debugLog("User Registration Save failed...".$userAccount->getUserId());
					$this->sqlExec->rollBack();
				}
			}catch(Exception $e) {
				$this->log->debugLog("User Registration Save failed...".$userAccount->getUserId());
				$this->sqlExec->rollBack();
			}
		}
		return $stat;
	}
	
	public function updateUser($userAccount) {
		$stat=0;
		try {
			$query="update userregistration_t set "
				."name=".quote($userAccount->getName())
				.",familyname=".quote($userAccount->getFamilyName())
				.",gender=".quote($userAccount->getGender())
				.",dob=".quote(convertFromUserDateToYmd($userAccount->getDOB()))
				.",maritalstatus=".quote($userAccount->getMaritalStatus())
				.",spousename=".quote($userAccount->getSpouseName())
				.",qualification=".quote($userAccount->getQualification())
				.",fulladdress=".quote($userAccount->getFullAddress())
				.",city=".quote($userAccount->getCity())
				.",state=".quote($userAccount->getState())
				.",zipcode=".quote($userAccount->getZipCode())
				.",mobilenumber=".quote($userAccount->getMobileNumber())
				.",phonenumber=".quote($userAccount->getPhoneNumber())
				.",email=".quote($userAccount->getEmail())
				.",aboutme=".quote($userAccount->getAboutMe())
				.",aboutfamily=".quote($userAccount->getAboutFamily())
				.",photopath=".quote($userAccount->getPhotoPath())
				.",completedstage=".quote($userAccount->getCompletedStage())
				.",deleted=".quote($userAccount->getDeleted())
					." where uid=".quote($userAccount->getUId());
			$this->log->debugLog("updateUser : ".$query);
			$this->sqlExec = new SqlExecution();
			if($this->sqlExec->execute($query)){
				$stat=1;
			}
		}
		catch(Exception $e) {
			throw new Exception("Cannot Update User Registration detials..".$e->getMessage());
		}
		return $stat;
	}
	public function addMember($otherMemberObj){
		try {
			$query = "insert into othermembers_t (uid, name, gender,  dob, relation) values " ;
			$query .= "( " 
			. quote($otherMemberObj->getUId()) . "," 
			. quote($otherMemberObj->getName()) . "," 
			. quote($otherMemberObj->getGender()) . "," 
			. quote(convertFromUserDateToYmd($otherMemberObj->getDob())) . "," 
			. quote($otherMemberObj->getRelation()) 
			. ")";
			$this->executeInsert($query);
		}catch(Exception $e) {
			throw new Exception("Cannot Update User addMember detials..".$e->getMessage());
		}
	}	
	public function updateMember($otherMemberObj){
		try {
			$query = "update othermembers_t set " 
					. "name = ". quote($otherMemberObj->getName()) . "," 
					. "gender = ".  quote($otherMemberObj->getGender()) . "," 
					. "dob = ". quote(convertFromUserDateToYmd($otherMemberObj->getDob())) . "," 
					. "relation = ".  quote($otherMemberObj->getRelation()) 
							. " where uid = " . quote($otherMemberObj->getUId())." and memberid=". quote($otherMemberObj->getMemberId());
			$this->executeUpdate($query,"updateMember");
		}catch(Exception $e) {
			throw new Exception("Cannot Update User addMember detials..".$e->getMessage());
		}
	}

	public function deleteMember($uId,$memberId){
		try {
			$query = "update othermembers_t set deleted=1 where uid = " . quote($uId)." and memberid=". quote($memberId);
			$this->executeUpdate($query,"delMembers");
		}catch(Exception $e) {
			throw new Exception("Cannot Update User addMember detials..".$e->getMessage());
		}
	}

	public function getMember($uId,$memberId){
		$otherMemberObj=null;
		try{
			$query = "select memberid, uid, name, gender , dob , relation from othermembers_t "
						." where uid = " . quote($uId)." and memberid=". quote($memberId). " and deleted = 0";
			$results=$this->executeQuery($query,"getMember");
			while($row=mysqli_fetch_array($results)){
				$otherMemberObj = new OtherMember;
				$otherMemberObj->setUId($row["uid"]);
				$otherMemberObj->setMemberId($row["memberid"]);
				$otherMemberObj->setName($row["name"]);
				$otherMemberObj->setRelation($row["relation"]);
				$otherMemberObj->setDob($row["dob"]);
				$otherMemberObj->setGender( $row["gender"]);
			}
		}catch(Exception $e){
		}
		return $otherMemberObj;
	}	
	public function getMembers($uId){
		$members=array();
		try{
			$query = "select memberid, uid, name, gender , dob , relation from othermembers_t where uid = " . quote($uId). " and deleted = 0";
			$results=$this->executeQuery($query,"getMembers");
			while($row=mysqli_fetch_array($results)){
				$otherMemberObj = new OtherMember;
				$otherMemberObj->setUId($row["uid"]);
				$otherMemberObj->setMemberId($row["memberid"]);
				$otherMemberObj->setName($row["name"]);
				$otherMemberObj->setRelation($row["relation"]);
				$otherMemberObj->setDob($row["dob"]);
				$otherMemberObj->setGender( $row["gender"]);
				$members[]= $otherMemberObj;
			}
		}catch(Exception $e){
		}
		return $members;
	}
	public function getUserById($userId) {
		try{
		$query = "select ".$this->basicDataString." from useraccount_t a,userregistration_t b "
        	." where  a.userid=b.userid and a.userid=".quote($userId)." and b.deleted=0";
			return $this->executeQuery($query,"getUserById");
		}
		catch(Exception $e) {
			throw new Exception("Cannot get getUserDataByUserName..".$e->getMessage());
		}
	}
	
	public function activateByUserId($userId,$value) {
		try{
				$stat=0;
				$activationKey=$this->generateActivationKey($userId);
				$query =" update useraccount_t set activated=".quote($value)." , "
								." activationdata=".quote($activationKey)
									." where userid= ".quote($userId) ;
			 return $this->executeUpdate($query,"activate");
		}
		catch(Exception $e){
			throw new Exception(" Cannot activate user account..".$e->getMessage());
		}
	}
	public function updateActivationKeyByUserId($userId) {
		try{
				$activationKey=$this->generateActivationKey($userId);
				$query =" update useraccount_t set  activationdata=".quote($activationKey)
									." where userid= ".quote($userId) ;
			 return $this->executeUpdate($query,"updateActivationKeyByUserId");
		}
		catch(Exception $e){
			throw new Exception(" Cannot activate user account..".$e->getMessage());
		}
	}	
	
	public function updActivateData($activationData,$userId) {
		try{
				$stat=0;
				$query =" update useraccount_t set activationdata=".quote($activationData)
									." where userid= ".quote($userId) ;
			 return $this->executeUpdate($query,"activate");
		}
		catch(Exception $e){
			throw new Exception(" Cannot activate user account..".$e->getMessage());
		}
	}
	
	public function updateLastLoginTime($userId) {
		try {
			$query="update userregistration_t set lastlogintime=".quote(date("Y-m-d H:i:s"))
			." where userid=".quote($userId);

			return $this->executeUpdate($query,"updateLastLoginTime");
		}
		catch(Exception $e) {
			throw new Exception("Cannot Update last login..".$e->getMessage());
		}
	}

	public function updateUserImage($userId,$photoPath) {
		try {
			$query="update userregistration_t set "
					."photopath=".quote($photoPath)
					." where userid=".quote($userId)." and deleted=0";

			return $this->executeUpdate($query,"updateUserImage");
		}
		catch(Exception $e) {
			throw new Exception("Cannot Update profile image ..".$e->getMessage());
		}
	}
	
	public function getUserAccountByUserId($userId) {
		$userAccount = NULL;
		try {
		$query = " select ".$this->basicDataString
				.",a.passwd,a.saltkey,a.sessionid,a.activated,a.activationdata,a.activatedon"
				." from useraccount_t a,userregistration_t b "
         		." where a.userid =".quote($userId) ." and a.uid=b.uid and b.deleted=0 ";
			return $this->getUserAccountObj($query);
		}
		catch(Exception $e) {
			throw new Exception("Errrr..".$e->getMessage());
		}
	}
	public function getUserAccountByUId($uId) {
		$userAccount = NULL;
		try {
		$query = " select ".$this->basicDataString
				.",a.passwd,a.saltkey,a.sessionid,a.activated,a.activationdata,a.activatedon"
				." from useraccount_t a,userregistration_t b "
         		." where a.uid =".quote($uId) ." and a.uid=b.uid and b.deleted=0 ";
			return $this->getUserAccountObj($query);
		}
		catch(Exception $e) {
			throw new Exception("Errrr..".$e->getMessage());
		}
	}
	private function getUserAccountObj($query) {
		$userAccount = NULL;
		try {
			$results=$this->executeQuery($query,"getUserAccountObj");
			while($row = mysqli_fetch_array($results)) {
				$userAccount = new RegUserAccount();
				$userAccount->setUId($row["uid"]);
				$userAccount->setUserId($row["userid"]);
				$userAccount->setPasswd($row["passwd"]);
				$userAccount->setSaltKey($row["saltkey"]);
				$userAccount->setSessionId($row["sessionid"]);
				$userAccount->setActivated($row["activated"]);
				$userAccount->setActivationData($row["activationdata"]);
				$userAccount->setActivatedOn($row["activatedon"]);
				$userAccount->setName($row["name"]);
				$userAccount->setFamilyName($row["familyname"]);
				$userAccount->setGender($row["gender"]);
				$userAccount->setDOB($row["dob"]);
				$userAccount->setMaritalStatus($row["maritalstatus"]);
				$userAccount->setSpouseName($row["spousename"]);
				$userAccount->setQualification($row["qualification"]);
				$userAccount->setFullAddress($row["fulladdress"]);
				$userAccount->setZipCode($row["zipcode"]);
				$userAccount->setCity($row["city"]);
				$userAccount->setState($row["state"]);
				$userAccount->setMobileNumber($row["mobilenumber"]);
				$userAccount->setPhoneNumber($row["phonenumber"]);
				$userAccount->setEmail($row["email"]);
				$userAccount->setPhotoPath($row["photopath"]);
				$userAccount->setAboutMe($row["aboutme"]);
				$userAccount->setAboutFamily($row["aboutfamily"]);
				$userAccount->setCompletedStage($row["completedstage"]);
				$userAccount->setDeleted($row["deleted"]);
				$userAccount->setCreatedOn($row["createdon"]);
				$userAccount->setCreatedBy($row["createdby"]);
				return $userAccount;
			}
		}
		catch(Exception $e) {
			throw new Exception("Cannot get User Account details..".$e->getMessage());
		}
		return $userAccount;
	}
	
	public function getAllRegUsers($resultType,$searchStr="",$startNo=0,$blockSize=9) {
 		try{
 			$searchString=($searchStr!="")? " name like ".quote("%".$searchStr."%")." and " : "" ;
 			$cnt=0;
			$limit=" LIMIT $startNo, $blockSize";
 			$orderby=" order by familyname,uid";
 			if($resultType=='DATACOUNT')
 				$query = "select count(a.uid) as cnt from useraccount_t a,userregistration_t b "
					." where ".$searchString."  a.uid=b.uid and b.deleted=0 ";  
 			else
 				$query = "select ".$this->basicDataString ." from useraccount_t a,userregistration_t b "
					." where ".$searchString."  a.uid=b.uid and b.deleted=0 ". $orderby . $limit;;
 			$results=$this->executeQuery($query,"getAllRegUsers");
 			if($resultType=='DATACOUNT'){
 				while($row=mysqli_fetch_array($results)){ 
 					$cnt=$row['cnt'];
 				}
 				return $cnt;
 			}
 			return $results;
 		}
 		catch(Exception $e) {
 			throw new Exception("Cannot get getAllRegUsers..".$e->getMessage());
 		}
 	}	
	
	public function getLatestRegUsers($limit=10) {
 		try{
			$day=date("d"); $month=date("m"); $year=date("Y");
 			//$searchString="day(b.createdon)=".quote($day)." and month(b.createdon)=".quote($month)." and year(b.createdon)=".quote($year) ;
 			$searchString=" a.uid=b.uid and b.deleted=0" ;

 			$query = "select ".$this->basicDataString ." from useraccount_t a,userregistration_t b "
					." where ".$searchString."  order by b.createdon desc limit ".$limit;
 			$results=$this->executeQuery($query,"getLatestRegUsers");
 			return $results;
 		}
 		catch(Exception $e) {
 			throw new Exception("Cannot get getLatestRegUsers..".$e->getMessage());
 		}
 	}
						
	public function isInBlockedList($emailId) {
		$emailId=str_replace(" ","",$emailId);
		$query = "select email_id from blockregister  where email_id =".quote($emailId);
		$results=$this->executeQuery($query,"isInBlockedList");
		while($row = mysqli_fetch_array($results)) {
			return true;
		}
		return false;
	}
	public function generateActivationKey($userId){
		return encrypt($userId.date('Y-m-d H:i:s'),"ActivationDataKey".date('Y-m-d H:i:s'));
	}
	
	public function getNewRandomPassword() {
		return encrypt(date('Y-m-d H:i:s'),"StStephenChurch_engine");
	}
	public static function generateSaltKey($prikey) {
		return encrypt($prikey.date('Y-m-d H:i:s'),"StStephenChurch_engine");
	}


	public function addLoginActivity($userId,$sessionId) {
		$this->removeAllLoginActivity($userId);
		$ipaddress=$_SERVER["REMOTE_ADDR"];
		$hashkey= md5($userId);
		$query="insert into loginactivity_t(userid,logintime,lastupdate,ipaddress,hashkey,sessionid)"
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
		$cnt=0;
		try {
			$cnt=$this->selectLoginActivity($userId,$sessionId);
			if($cnt>0){
				$query="update loginactivity_t set "
				." lastupdate=".quote(date('Y-m-d H:i:s'))
				." where userid=".quote($userId)	." and sessionid=".quote($sessionId);
				$updcnt=$this->executeUpdate($query,"checkUserVerification");
			}
		}
		catch(Exception $e) {
			throw new Exception("Cannot Activate User..".$e->getMessage());
		}
		return $cnt;
	}
	
	public function selectLoginActivity($userId,$sessionId) {
		$query="select  lastupdate from loginactivity_t  where userid=".quote($userId)." and sessionid=".quote($sessionId);
		$results=$this->executeQuery($query,"selectLoginActivity");
		return mysqli_num_rows($results);
	}
	public function removeUnUsedLoginActivity() {
		$query="delete  from loginactivity_t where lastupdate<=".quote(date('Y-m-d H:i:s', strtotime("-1 days")));
		$n=$this->executeUpdate($query,"removeUnUsedLoginActivity");
	}
	
	public function removeAllLoginActivity($userId) {
		$query="delete  from loginactivity_t where userid=".quote($userId);
		$n=$this->executeUpdate($query,"removeAllLoginActivity");
	}
	public function removeLoginActivity($userId,$sessionId) {
		$query="delete  from loginactivity_t where userid=".quote($userId)." and sessionid=".quote($sessionId);
		$n=$this->executeUpdate($query,"removeLoginActivity");
	}
	public function getLoginActivity($ip) {
		$query="select  userid,ipaddress,hashkey from loginactivity_t where ipaddress=".quote($ip);
		return $this->executeQuery($query,"getLoginActivity");
	}

	public function addUserActivity($userId,$activity) {
		$userActivity=new UserActivity();
		$userActivity->setActivityPerformed($activity);
		$userActivity->setHostName($_SERVER["REMOTE_ADDR"]);
		$userActivity->setUserAgent($_SERVER["HTTP_USER_AGENT"]);
		$userActivity->setCreatedBy($userId);

		$query="insert into useractivity(activityperformed,hostname,useragent,createdby)"
		."values("
			.quote($userActivity->getActivityPerformed()).","
			.quote($userActivity->getHostName()).","
			.quote($userActivity->getUserAgent()).","
			.quote($userActivity->getCreatedBy())
		.")";

		return $this->executeInsert($query,"addUserActivity");
	}
	public function generateUniqueUserId($userAccount,$uid) {
		try{
			$userId="";
			$userId.=$uid;
			$this->log->debugLog(" generated userId:  ".$userId);
			return $userId;
		}
		catch(Exception $e) {
			throw new Exception("Error while Insert..".$e->getMessage());
		}
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
