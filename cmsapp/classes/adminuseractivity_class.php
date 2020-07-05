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
* User Actitvity Information
*
*/
class AdminUserActivity
{
	private $m_ActivityId ;	// ActivityId
	private $m_ActivityPerformed ;	// ActivityPerformed
	private $m_HostName ;	// host name/IP address
	private $m_CreatedOn ;	// created on
	private $m_CreatedBy ;	// created by

	public function __construct()
	{
		$this->m_ActivityId =0;
		$this->m_ActivityPerformed ="";
		$this->m_HostName ="";
		$this->m_CreatedOn = date("Y-m-d H:i:s");
		$this->m_CreatedBy ="";
	}

	public function setUserActivityData($m_ActivityId,$m_ActivityPerformed,$m_HostName,$m_CreatedOn,$m_CreatedBy)
	{
		$this->m_ActivityId =$m_ActivityId;
		$this->m_ActivityPerformed = $m_ActivityPerformed;
		$this->m_HostName = $m_HostName;
		$this->m_CreatedOn = $m_CreatedOn;
		$this->m_CreatedBy = $m_CreatedBy;
	}

	public function setActivityId($value)
	{
		$this->m_ActivityId = $value;
	}

	public function getActivityId()
	{
		return $this->m_ActivityId;
	}

	public function setActivityPerformed($value)
	{
		$this->m_ActivityPerformed = $value;
	}

	public function getActivityPerformed()
	{
		return $this->m_ActivityPerformed;
	}

	public function setHostName($value)
	{
		$this->m_HostName = $value;
	}

	public function getHostName()
	{
		return $this->m_HostName;
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
	public function __toString()
	{
		return $this->getUserId();
	}

}
?>
