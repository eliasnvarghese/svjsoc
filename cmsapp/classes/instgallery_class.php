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
* Posting
*
*/
class InstGallery
{
	private $m_ImageId ;	// Video Id
	private $m_Inst_Id ;	// InstId
	private $m_ImageType ;	// Type of Image
	private $m_FileName ;	//  Image Path
	private $m_Title ;	// Title
	private $m_Description ;	//  description
	private $m_Deleted ;	//  Deleted
	private $m_CreatedOn ;	// created on
	private $m_CreatedBy ;	// created by

	public function __construct()
	{
		$this->m_ImageId = 0;
		$this->m_Inst_Id = 0;
		$this->m_ImageType ="";
		$this->m_FileName ="";
		$this->m_Title ="";
		$this->Description ="";
		$this->m_Deleted =1;
		$this->m_CreatedOn = date("Y-m-d H:i:s");
		$this->m_CreatedBy ="";
	}

	public function setImageId($value)
	{
		$this->m_ImageId = $value;
	}

	public function getImageId()
	{
		return $this->m_ImageId;
	}
	
	public function setInst_Id($value)
	{
		$this->m_Inst_Id = $value;
	}

	public function getInst_Id()
	{
		return $this->m_Inst_Id;
	}
	
	public function setImageType($value)
	{
		$this->m_ImageType = $value;
	}

	public function getImageType()
	{
		return $this->m_ImageType;
	}
	
	public function setFileName($value)
	{
		$this->m_FileName = $value;
	}

	public function getFileName()
	{
		return $this->m_FileName;
	}

	public function setTitle($value)
	{
		$this->m_Title = $value;
	}

	public function getTitle()
	{
		return $this->m_Title;
	}

	public function setDescription($value)
	{
		$this->Description = $value;
	}

	public function getDescription()
	{
		return $this->Description;
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
		return $this->getImageId();
	}

}
?>
