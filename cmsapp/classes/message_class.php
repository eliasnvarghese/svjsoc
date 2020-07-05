<?php
/*
 * @Project     :  Health Donor (A Micro donation website for poor
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	:
 * @modified date:
 */
?>
<?php
/*
* User mailing details
*
*/
class Message
{
	private $m_MessageId ;	// Mail Id
	private $m_ToUid;	// to uid
	private $m_ToAddress ;	// to address
	private $m_FromUid ;	// from uid
	private $m_FromAddress ;	// from address
	private $m_Subject ;	// message
	private $m_Message ;	// message
	private $m_Status;	// Status
	private $m_Tag ;	// tag
	private $m_CreatedOn ;	// created on
	private $m_CreatedBy ;	// created by

	public function __construct()
	{
		$this->m_MessageId = 0;
		$this->m_ToUid ="";
		$this->m_ToAddress ="";
		$this->m_FromUid ="";
		$this->m_FromAddress ="";
		$this->m_Subject ="";
		$this->m_Message ="";
		$this->m_Status ="";
		$this->m_Tag ="";
		$this->m_CreatedOn = date("Y-m-d H:i:s");
		$this->m_CreatedBy ="";
	}

	public function setMessageId($value)
	{
		$this->m_MessageId = $value;
	}

	public function getMessageId()
	{
		return $this->m_MessageId;
	}

	public function setToUid($value)
	{
		$this->m_ToUid = $value;
	}

	public function getToUid()
	{
		return $this->m_ToUid;
	}	
	public function setToAddress($value)
	{
		$this->m_ToAddress = $value;
	}

	public function getToAddress()
	{
		return $this->m_ToAddress;
	}

	public function setFromUid($value)
	{
		$this->m_FromUid = $value;
	}

	public function getFromUid()
	{
		return $this->m_FromUid;
	}
	public function setFromAddress($value)
	{
		$this->m_FromAddress = $value;
	}

	public function getFromAddress()
	{
		return $this->m_FromAddress;
	}

	public function setSubject($value)
	{
		$this->m_Subject = $value;
	}

	public function getSubject()
	{
		return $this->m_Subject;
	}
	public function setMessage($value)
	{
		$this->m_Message = $value;
	}

	public function getMessage()
	{
		return $this->m_Message;
	}	
	
	public function setStatus($value)
	{
		$this->m_Status = $value;
	}

	public function getStatus()
	{
		return $this->m_Status;
	}	
	public function setTag($value)
	{
		$this->m_Tag = $value;
	}

	public function getTag()
	{
		return $this->m_Tag;
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
		return $this->getMessageId();
	}

}
?>
