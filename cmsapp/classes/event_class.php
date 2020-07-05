<?php
/*
 * @Project     :  St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	:
 * @modified date:
 */
?>
<?php
/*
* 
*
*/
class Event
{
	private $m_EventId ;	// Event Id
	private $m_EventName ;	// m_EventName
	private $m_Highlights ;	// Highlights
	private $m_EventDetails ;	// EventDetails
	private $m_FromDate ;	//  FromDate
	private $m_ToDate ;	//  ToDate
	private $m_Deleted ;	//  Deleted
	private $m_CreatedOn ;	// created on
	private $m_CreatedBy ;	// created by

	public function __construct()
	{
		$this->m_EventId = 0;
		$this->m_EventName ="";
		$this->m_Highlights = 0;
		$this->m_EventDetails ="";
		$this->m_FromDate ="";
		$this->m_ToDate ="";
		$this->m_Deleted =1;
		$this->m_CreatedOn = date("Y-m-d H:i:s");
		$this->m_CreatedBy ="";
	}

	public function setEventId($value)
	{
		$this->m_EventId = $value;
	}

	public function getEventId()
	{
		return $this->m_EventId;
	}
	

	public function setEventName($value)
	{
		$this->m_EventName = $value;
	}

	public function getEventName()
	{
		return $this->m_EventName;
	}
	public function setHighlights($value)
	{
		$this->m_Highlights = $value;
	}

	public function getHighlights()
	{
		return $this->m_Highlights;
	}
	public function setEventDetails($value)
	{
		$this->m_EventDetails = $value;
	}

	public function getEventDetails()
	{
		return $this->m_EventDetails;
	}

	public function setFromDate($value)
	{
		$this->m_FromDate = $value;
	}

	public function getFromDate()
	{
		return $this->m_FromDate;
	}	
	
	public function setToDate($value)
	{
		$this->m_ToDate = $value;
	}

	public function getToDate()
	{
		return $this->m_ToDate;
	}

	public function setDeleted($value)
	{
		$this->m_Deleted = $value;
	}

	public function getDeleted()
	{
		return $this->m_Deleted;
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
		return $this->getEventId();
	}

}
?>
