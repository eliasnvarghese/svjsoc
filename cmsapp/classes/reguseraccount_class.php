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
class RegUserAccount
{
	private $m_UId;   //UId 
	private $m_UserId;   //UserId 
	
	private $m_Passwd ;	// password
	private $m_SaltKey ; // slatkey
	private $m_SessionId ;	// SessionId
	private $m_ActivationData ;	// Activation Data (userid+date) encrypted
	private $m_Activated ;	// Is Activated 0 - Initial 1 - Activated
	private $m_ActivatedOn ;	// Activated On
	
	private $m_Name;   //Name 
	private $m_Gender;   //Gender 
	private $m_DOB;   //DOB 	
	private $m_MaritalStatus;   //MaritalStatus 
	private $m_SpouseName;   //SpouseName 

	private $m_Qualification;   //Qualification 
	private $m_FullAddress;   //FullAddress 
	private $m_ZipCode;   //ZipCode 
	private $m_City;   //City 
	private $m_State;   //State 
	private $m_MobileNumber;   //MobileNumber 
	private $m_PhoneNumber;   //PhoneNumber 
	private $m_Email;   //Email 
	private $m_FamilyName;   //FamilyName 
	private $m_PhotoPath;   //PhotoPath 
	private $m_AboutMe;   //AboutMe 
	private $m_AboutFamily;   //AboutFamily 
	private $m_Deleted;   //Deleted 
	private $m_CompletedStage;   //CompletedStage 
	private $m_LastLoginTime;   //lastlogintime
	private $m_CreatedOn;   //CreatedOn 
	private $m_CreatedBy;   //CreatedBy 
	private $Members=array();
			
	public function __construct(){
			$this->m_UId=0;  
			$this->m_UserId=''; 
			
			$this->m_Passwd=''; 
			$this->m_SaltKey=''; 
			$this->m_SessionId=''; 
			$this->m_ActivationData=''; 
			$this->m_Activated='1'; 
			$this->m_ActivatedOn=''; 
			
			$this->m_Name='';  
			$this->m_Gender='';  
			$this->m_DOB='';  
			$this->m_MaritalStatus='';  
			$this->m_SpouseName='';  

			$this->m_Qualification='';  
			$this->m_FullAddress='';  
			$this->m_ZipCode='';  
			$this->m_City='';  
			$this->m_State='';  
			$this->m_MobileNumber='';  
			$this->m_PhoneNumber='';  
			$this->m_Email='';  
			$this->m_FamilyName='';  
			$this->m_PhotoPath='';  
			$this->m_AboutMe='';  
			$this->m_AboutFamily='';  
			$this->m_Deleted=0;  
			$this->m_CompletedStage='';  
			$this->m_LastLoginTime='';  
			$this->m_CreatedOn=date("Y-m-d H:i:s");  
			$this->m_CreatedBy='';  
			$this->Members=array();		
	}

	public function setUId($value){  
 		 $this->m_UId=$value;
	}

	public function getUId(){ 
 		 return $this->m_UId;
	}

	public function setUserId($value){  
 		 $this->m_UserId=$value;
	}

	public function getUserId(){ 
 		 return $this->m_UserId;
	}
	public function setPasswd($value){  
 		 $this->m_Passwd=$value;
	}

	public function getPasswd(){ 
 		 return $this->m_Passwd;
	}
	public function setSaltKey($value){  
 		 $this->m_SaltKey=$value;
	}

	public function getSaltKey(){ 
 		 return $this->m_SaltKey;
	}
	public function setSessionId($value){  
 		 $this->m_SessionId=$value;
	}

	public function getSessionId(){ 
 		 return $this->m_SessionId;
	}
	public function setActivationData($value){  
 		 $this->m_ActivationData=$value;
	}

	public function getActivationData(){ 
 		 return $this->m_ActivationData;
	}
	public function setActivated($value){  
 		 $this->m_Activated=$value;
	}

	public function getActivated(){ 
 		 return $this->m_Activated;
	}
	public function setActivatedOn($value){  
 		 $this->m_ActivatedOn=$value;
	}

	public function getActivatedOn(){ 
 		 return $this->m_ActivatedOn;
	}

	public function setName($value){  
 		 $this->m_Name=$value;
	}

	public function getName(){ 
 		 return ucfirst(trim($this->m_Name));
	}

	public function setGender($value){  
 		 $this->m_Gender=$value;
	}

	public function getGender(){ 
 		 return $this->m_Gender;
	}

	public function setDOB($value){  
 		 $this->m_DOB=$value;
	}

	public function getDOB(){ 
 		 return $this->m_DOB;
	}	
	public function setMaritalStatus($value){  
 		 $this->m_MaritalStatus=$value;
	}

	public function getMaritalStatus(){ 
 		 return $this->m_MaritalStatus;
	}

	public function setSpouseName($value){  
 		 $this->m_SpouseName=$value;
	}

	public function getSpouseName(){ 
 		 return $this->m_SpouseName;
	}

	public function setQualification($value){  
 		 $this->m_Qualification=$value;
	}

	public function getQualification(){ 
 		 return $this->m_Qualification;
	}

	public function setFullAddress($value){  
 		 $this->m_FullAddress=$value;
	}

	public function getFullAddress(){ 
 		 return $this->m_FullAddress;
	}

	public function setZipCode($value){  
 		 $this->m_ZipCode=$value;
	}

	public function getZipCode(){ 
 		 return $this->m_ZipCode;
	}

	public function setCity($value){  
 		 $this->m_City=$value;
	}

	public function getCity(){ 
 		 return $this->m_City;
	}

	public function setState($value){  
 		 $this->m_State=$value;
	}

	public function getState(){ 
 		 return $this->m_State;
	}

	public function setMobileNumber($value){  
 		 $this->m_MobileNumber=$value;
	}

	public function getMobileNumber(){ 
 		 return $this->m_MobileNumber;
	}

	public function setPhoneNumber($value){  
 		 $this->m_PhoneNumber=$value;
	}

	public function getPhoneNumber(){ 
 		 return $this->m_PhoneNumber;
	}

	public function setEmail($value){  
 		 $this->m_Email=$value;
	}

	public function getEmail(){ 
 		 return $this->m_Email;
	}

	public function setFamilyName($value){  
 		 $this->m_FamilyName=$value;
	}

	public function getFamilyName(){ 
 		 return $this->m_FamilyName;
	}

	public function setPhotoPath($value){  
 		 $this->m_PhotoPath=$value;
	}

	public function getPhotoPath(){ 
 		 return $this->m_PhotoPath;
	}

	public function setAboutMe($value){  
 		 $this->m_AboutMe=$value;
	}

	public function getAboutMe(){ 
 		 return $this->m_AboutMe;
	}
	
	public function setAboutFamily($value){  
 		 $this->m_AboutFamily=$value;
	}

	public function getAboutFamily(){ 
 		 return $this->m_AboutFamily;
	}

	public function setDeleted($value){  
 		 $this->m_Deleted=$value;
	}

	public function getDeleted(){ 
 		 return $this->m_Deleted;
	}

	public function setCompletedStage($value){  
 		 $this->m_CompletedStage=$value;
	}

	public function getCompletedStage(){ 
 		 return $this->m_CompletedStage;
	}
	public function setLastLoginTime($value){  
 		 $this->m_LastLoginTime=$value;
	}

	public function getLastLoginTime(){ 
 		 return $this->m_LastLoginTime;
	}

	public function setCreatedOn($value){  
 		 $this->m_CreatedOn=$value;
	}

	public function getCreatedOn(){ 
 		 return $this->m_CreatedOn;
	}

	public function setCreatedBy($value){  
 		 $this->m_CreatedBy=$value;
	}

	public function getCreatedBy(){ 
 		 return $this->m_CreatedBy;
	}
	public function getMembers(){
		return $this->Members;
	}	
	public function setMembers($memberArray){
		$this->Members=$memberArray;
	}
}
 ?>
