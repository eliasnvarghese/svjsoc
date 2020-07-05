   <?php
/*
 * @Project     :  St. StephenChurch
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 11/11/2018
 * @modified by	:
 * @modified date:
 */
?>
<?php
/*
* Posting
*
*/
class Posting
{
	private $m_PostingId ;	// Video Id
	private $m_Category ;	// Category
	private $m_SubCategory ;	// SubCategory
	private $m_ContentType ;	// Type of Content
	private $m_ContentId ;	// Content Id
	private $m_VideoType ;	// Type of Video
	private $m_VideoUrl ;	//  URL
	private $m_VideoLabel ;	//  Video ID provided by operator
	private $m_ImageType ;	// Type of Image
	private $m_ImagePath ;	//  Image Path
	private $m_Title ;	// Title
	private $m_Description ;	//  description
	private $m_Deleted ;	//  Deleted
	private $m_CreatedOn ;	// created on
	private $m_CreatedBy ;	// created by

	public function __construct()
	{
		$this->m_PostingId = 0;
		$this->m_Category ="";
		$this->m_SubCategory ="";
		$this->m_ContentType =0;
		$this->m_ContentId =0;
		$this->m_VideoType ="";
		$this->m_VideoUrl ="";
		$this->m_VideoLabel ="";
		$this->m_ImageType ="";
		$this->m_ImagePath ="";
		$this->m_Title ="";
		$this->Description ="";
		$this->m_Deleted =1;
		$this->m_CreatedOn = date("Y-m-d H:i:s");
		$this->m_CreatedBy ="";
	}

	public function setPostingId($value)
	{
		$this->m_PostingId = $value;
	}

	public function getPostingId()
	{
		return $this->m_PostingId;
	}
	public function setCategory($value)
	{
		$this->m_Category = $value;
	}
	
	public function getCategory()
	{
		return $this->m_Category;
	}
	public function setSubCategory($value)
	{
		$this->m_SubCategory = $value;
	}
	
	public function getSubCategory()
	{
		return $this->m_SubCategory;
	}

	public function setContentType($value)
	{
		$this->m_ContentType = $value;
	}

	public function getContentType()
	{
		return $this->m_ContentType;
	}	
	
	public function setContentId($value)
	{
		$this->m_ContentId = $value;
	}

	public function getContentId()
	{
		return $this->m_ContentId;
	}
	
	public function setVideoType($value)
	{
		$this->m_VideoType = $value;
	}

	public function getVideoType()
	{
		return $this->m_VideoType;
	}
	
	public function setVideoUrl($value)
	{
		$this->m_VideoUrl = $value;
	}

	public function getVideoUrl()
	{
		return $this->m_VideoUrl;
	}
	
	public function setVideoLabel($value)
	{
		$this->m_VideoLabel = $value;
	}

	public function getVideoLabel()
	{
		return $this->m_VideoLabel;
	}
	
	public function setImageType($value)
	{
		$this->m_ImageType = $value;
	}

	public function getImageType()
	{
		return $this->m_ImageType;
	}
	
	public function setImagePath($value)
	{
		$this->m_ImagePath = $value;
	}

	public function getImagePath()
	{
		return $this->m_ImagePath;
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
		return $this->getPostingId();
	}

}
?>
