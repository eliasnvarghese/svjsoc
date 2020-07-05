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
* User Data details
*
*/
class AdminUserData
{
	private $m_UId ;	// user  id
	private $m_ClientId ;	// user Client id
	private $m_UserId ;	// user email id
	private $m_SessionId ;	// session id
	private $m_Name ;	//  Name (Fname+mName+Lname)
	private $m_UserName ;	// User Name 
	private $m_Activated ;	// Activated 0 /1
	private $m_ActivationData ;	// ActivationData
	private $m_ActivatedOn ;	// ActivatedOn
	private $m_ThemeId ;	// ThemeId
	private $m_PhotoPath ;	// PhotoPath

	public function __construct()
	{
		$this->m_UId =0;
		$this->m_UserId ="";
		$this->m_ClientId ="";
		$this->m_SessionId ="";
		$this->m_Name ="";
		$this->m_UserName ="";
		$this->m_Activated =0;
		$this->m_ActivationData ="";
		$this->m_ActivatedOn ="";
 		$this->m_ThemeId = 0;
		$this->m_PhotoPath="";

	}

	public function setUserDataData($m_UId,$m_UserId,$m_SessionId,$m_Name,$m_Activated)
	{
		$this->m_UId = $m_UId;
		$this->m_UserId = $m_UserId;
		$this->m_SessionId = $m_SessionId;
		$this->m_Name = $m_Name;
		$this->m_Activated =$m_Activated;
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

	public function setUId($value)
	{
		$this->m_UId = $value;
	}

	public function getUId()
	{
		return $this->m_UId;
	}
	public function setUserName($value)
	{
		$this->m_UserName = $value;
	}

	public function getUserName()
	{
		return $this->m_UserName;
	}

	public function setSessionId($value)
	{
		$this->m_SessionId = $value;
	}

	public function getSessionId()
	{
		return $this->m_SessionId;
	}

	public function setName($value)
	{
		$this->m_Name = $value;
	}

	public function getName()
	{
		return $this->m_Name;
	}

	public function setActivated($value)
	{
		$this->m_Activated = $value;
	}

	public function getActivated()
	{
		return $this->m_Activated;
	}

	public function setActivationData($value)
	{
		$this->m_ActivationData = $value;
	}

	public function getActivationData()
	{
		return $this->m_ActivationData;
	}

	public function setActivatedOn($value)
	{
		$this->m_ActivatedOn = $value;
	}

	public function getActivatedOn()
	{
		return $this->m_ActivatedOn;
	}
	
	public function setThemeId($value)
	{
		$this->m_ThemeId = $value;
	}

	public function getThemeId()
	{
		return $this->m_ThemeId;
	}
	
	public function setPhotoPath($value)
	{
		$this->m_PhotoPath = $value;
	}

	public function getPhotoPath()
	{
		return $this->m_PhotoPath;
	}

	//Public Mehtods Starts Here
	public function __toString()
	{
		return $this->getUserId();
	}

}
?>
