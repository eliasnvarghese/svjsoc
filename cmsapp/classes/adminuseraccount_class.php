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
* User Account details
*
*/
class AdminUserAccount
{

	private $m_UId ;	// uniq serial id
	private $m_ClientId ;	// m_ClientId id
	private $m_UserId ;	// user id
	private $m_UserName ;	// user name/ email id
	private $m_Passwd ;	// password
	private $m_SaltKey ; // slatkey
	private $m_SessionId ;	// SessionId
	private $m_ActivationData ;	// Activation Data (userid+date) encrypted
	private $m_Activated ;	// Is Activated 0 - Initial 1 - Activated
	private $m_ActivatedOn ;	// Activated On
	private $m_FirstName ;	// FirstName
	private $m_LastName ;	// LastName
	private $m_Gender ;	// Gender
	private $m_OrganizationName ;	// OrganizationName
	private $m_Designation ;	// Designation
	private $m_Address ;	// Address
	private $m_City ;	// City
	private $m_State ;	// State
	private $m_Country ;	// Country
	private $m_Zipcode ;	// Zipcode
	private $m_Dob ;	// Dob
	private $m_ContactNumber ;	// ContactNumber
	private $m_MobileNumber ;	// MobileNumber
	private $m_SecurityQuestion ;	// SecurityQuestion
	private $m_SecurityAnswer ;	// SecurityAnswer
	private $m_AltEmailId ;	// AltEmailId
	private $m_PhotoPath ;	// PhotoPath
	private $m_StudiedAt ;	// Cover Photo
	private $m_ProfStatus ;	// ProfStatus
	private $m_Tagline;
	private $m_Aboutme;
	private $m_ThemeId ;	// ThemeId
	private $m_ProfileSecurity ;	// ProfileSecurity
	private $m_Community;
	private $m_Country_code ;
	private $m_Region_code ;
	private $m_Longitude ;
	private $m_Latitude ;
	private $m_TimeZone ;
	private $m_CreatedOn ;	// CreatedOn
	private $m_CreatedBy ;	// CreatedBy

	public function __construct()
	{
		$this->m_UId =0;
		$this->m_ClientId ="";
		$this->m_UserId ="";
		$this->m_UserName ="";
		$this->m_Passwd ="";
		$this->m_SaltKey ="";
		$this->m_SessionId ="";
		$this->m_ActivationData ="";
		$this->m_Activated = 0;
		$this->m_ActivatedOn = date("Y-m-d H:i:s");
		$this->m_FirstName = "";
		$this->m_LastName = "";
		$this->m_Gender = "";
		$this->m_OrganizationName = "";
		$this->m_Designation = "";
		$this->m_Address = "";
		$this->m_City = "";
		$this->m_State = "";
		$this->m_Country = "";
		$this->m_Zipcode = "";
		$this->m_Dob = date("Y-m-d H:i:s");
		$this->m_ContactNumber = "";
		$this->m_MobileNumber = "";
		$this->m_SecurityQuestion = "";
		$this->m_SecurityAnswer = "";
		$this->m_AltEmailId = "";
		$this->m_PhotoPath = "";
		$this->m_StudiedAt = "";
		$this->m_ProfStatus = "";
		$this->m_Tagline="";
		$this->m_Aboutme="";

		$this->m_ThemeId = 0;
		$this->m_ProfileSecurity = 9;
		$this->m_Community='';
		$this->m_Country_code='';
		$this->m_Region_code='';
		$this->m_Longitude= "" ;
		$this->m_Latitude= "" ;
		$this->m_TimeZone= "" ;
		$this->m_CreatedOn = date("Y-m-d H:i:s");
		$this->m_CreatedBy = "";
	}

	public function setUserId($value)
	{
		$this->m_UserId = $value;
	}

	public function getUserId()
	{
		return $this->m_UserId;
	}
	public function setClientId($value)
	{
		$this->m_ClientId = $value;
	}

	public function getClientId()
	{
		return $this->m_ClientId;
	}
	
	public function setUserName($value)
	{
		$this->m_UserName = $value;
	}

	public function getUserName()
	{
		return $this->m_UserName;
	}
	
	public function setUId($value)
	{
		$this->m_UId = $value;
	}

	public function getUId()
	{
		return $this->m_UId;
	}

	public function setPasswd($value)
	{
		$this->m_Passwd = $value;
	}

	public function getPasswd()
	{
		return $this->m_Passwd;
	}	
	
	public function setSaltKey($value)
	{
		$this->m_SaltKey = $value;
	}

	public function getSaltKey()
	{
		return $this->m_SaltKey;
	}

	public function setSessionId($value)
	{
		$this->m_SessionId = $value;
	}

	public function getSessionId()
	{
		return $this->m_SessionId;
	}

	public function setActivationData($value)
	{
		$this->m_ActivationData = $value;
	}

	public function getActivationData()
	{
		return $this->m_ActivationData;
	}

	public function setActivated($value)
	{
		$this->m_Activated = $value;
	}

	public function getActivated()
	{
		return $this->m_Activated;
	}

	public function setActivatedOn($value)
	{
		$this->m_ActivatedOn = $value;
	}

	public function getActivatedOn()
	{
		return $this->m_ActivatedOn;
	}

	public function setFirstName($value)
	{
		$this->m_FirstName = $value;
	}

	public function getFirstName()
	{
		return $this->m_FirstName;
	}

	public function setLastName($value)
	{
		$this->m_LastName = $value;
	}

	public function getLastName()
	{
		return $this->m_LastName;
	}


	
	public function setGender($value)
	{
		$this->m_Gender = $value;
	}

	public function getGender()
	{
		return $this->m_Gender;
	}

	public function setOrganizationName($value)
	{
		$this->m_OrganizationName = $value;
	}

	public function getOrganizationName()
	{
		return $this->m_OrganizationName;
	}

	public function setDesignation($value)
	{
		$this->m_Designation = $value;
	}

	public function getDesignation()
	{
		return $this->m_Designation;
	}

	public function setAddress($value)
	{
		$this->m_Address = $value;
	}

	public function getAddress()
	{
		return $this->m_Address;
	}

	public function setCity($value)
	{
		$this->m_City = $value;
	}

	public function getCity()
	{
		return $this->m_City;
	}

	public function setState($value)
	{
		$this->m_State = $value;
	}

	public function getState()
	{
		return $this->m_State;
	}

	public function setCountry($value)
	{
		$this->m_Country = $value;
	}

	public function getCountry()
	{
		return $this->m_Country;
	}

	public function setZipcode($value)
	{
		$this->m_Zipcode = $value;
	}

	public function getZipcode()
	{
		return $this->m_Zipcode;
	}

	public function setDob($value)
	{
		$this->m_Dob = $value;
	}

	public function getDob()
	{
		return $this->m_Dob;
	}

	public function setContactNumber($value)
	{
		$this->m_ContactNumber = $value;
	}

	public function getContactNumber()
	{
		return $this->m_ContactNumber;
	}

	public function setMobileNumber($value)
	{
		$this->m_MobileNumber = $value;
	}

	public function getMobileNumber()
	{
		return $this->m_MobileNumber;
	}

	public function setSecurityQuestion($value)
	{
		$this->m_SecurityQuestion = $value;
	}

	public function getSecurityQuestion()
	{
		return $this->m_SecurityQuestion;
	}

	public function setSecurityAnswer($value)
	{
		$this->m_SecurityAnswer = $value;
	}

	public function getSecurityAnswer()
	{
		return $this->m_SecurityAnswer;
	}

	public function setAltEmailId($value)
	{
		$this->m_AltEmailId = $value;
	}

	public function getAltEmailId()
	{
		return $this->m_AltEmailId;
	}

	public function setPhotoPath($value)
	{
		$this->m_PhotoPath = $value;
	}

	public function getPhotoPath()
	{
		return $this->m_PhotoPath;
	}

	public function setProfStatus($value)
	{
		$this->m_ProfStatus = $value;
	}

	public function getProfStatus()
	{
		return $this->m_ProfStatus;
	}

	public function setStudiedAt($value)
	{
		$this->m_StudiedAt = $value;
	}

	public function getStudiedAt()
	{
		return $this->m_StudiedAt;
	}

	public function setTagline($value)
	{
		 $this->m_Tagline=$value; 
	}      

	public function getTagline()
	{
		 return $this->m_Tagline; 
	}

	public function setAboutme($value)
	{
		 $this->m_Aboutme=$value; 
	}      

	public function getAboutme()
	{
		 return $this->m_Aboutme; 
	}

	public function setThemeId($value)
	{
		$this->m_ThemeId = $value;
	}

	public function getThemeId()
	{
		return $this->m_ThemeId;
	}

	public function setProfileSecurity($value)
	{
		$this->m_ProfileSecurity = $value;
	}

	public function getProfileSecurity()
	{
		return $this->m_ProfileSecurity;
	}

	public function setCommunity($value)
	{
		$this->m_Community = $value;
	}

	public function getCommunity()
	{
		return $this->m_Community;
	}
	public function setCountryCode($value)
	{
		$this->m_Country_code = $value;
	}

	public function getCountryCode()
	{
		return $this->m_Country_code;
	}
	public function setRegionCode($value)
	{
		$this->m_Region_code = $value;
	}

	public function getRegionCode()
	{
		return $this->m_Region_code;
	}
	public function setLongitude($value)
	{
		$this->m_Longitude = $value;
	}

	public function getLongitude()
	{
		return $this->m_Longitude;
	}
	public function setLatitude($value)
	{
		$this->m_Latitude = $value;
	}

	public function getLatitude()
	{
		return $this->m_Latitude;
	}
	public function setTimeZone($value)
	{
		$this->m_TimeZone = $value;
	}

	public function getTimeZone()
	{
		return $this->m_TimeZone;
	}

	public function setCreatedOn($value)
	{
		$this->m_CreatedOn = $value;
	}

	public function getCreatedOn()
	{
		return $this->m_CreatedOn;
	}

	public function setCreatedBy($value)
	{
		$this->m_CreatedBy = $value;
	}

	public function getCreatedBy()
	{
		return $this->m_CreatedBy;
	}


	//Public Mehtods Starts Here
	public function getFullName()
	{
		return trim($this->m_FirstName)." ".trim($this->m_LastName);
	}
	
	public function __toString()
	{
		return $this->getUserId();
	}
	

}
