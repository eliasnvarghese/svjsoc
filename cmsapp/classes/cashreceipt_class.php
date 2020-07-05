<?php 
class CashReceipt
{
	private $m_Rectno;   //Rectno 
	private $m_UId;   //UId 
	private $m_Serialno;   //Serialno 
	private $m_Rectdate;   //Rectdate 
	private $m_CategoryCode;   //CategoryCode 
	private $m_Rectdetls;   //Rectdetls 
	private $m_Rectamount;   //Rectamount 
	private $m_Cancelled;   //Cancelled 
	private $m_Createdon;   //Createdon 
	private $m_Createdby;   //Createdby 
	public function __construct(){
		$this->m_Rectno='';  
		$this->m_UId='';  
		$this->m_Serialno='';  
		$this->m_Rectdate='';  
		$this->m_CategoryCode='';
		$this->m_Rectdetls='';  
		$this->m_Rectamount='';  
		$this->m_Cancelled='';  
		$this->m_Createdon='';  
		$this->m_Createdby='';  
	}

	public function setRectno($value){  
 		 $this->m_Rectno=$value;
	}

	public function getRectno(){ 
 		 return $this->m_Rectno;
	}

	public function setUId($value){  
 		 $this->m_UId=$value;
	}

	public function getUId(){ 
 		 return $this->m_UId;
	}

	public function setSerialno($value){  
 		 $this->m_Serialno=$value;
	}

	public function getSerialno(){ 
 		 return $this->m_Serialno;
	}

	public function setRectdate($value){  
 		 $this->m_Rectdate=$value;
	}

	public function getRectdate(){ 
 		 return $this->m_Rectdate;
	}
	public function setCategoryCode($value)
	{
		$this->m_CategoryCode = $value;
	}
	
	public function getCategoryCode()
	{
		return $this->m_CategoryCode;
	}
	public function setRectdetls($value){  
 		 $this->m_Rectdetls=$value;
	}

	public function getRectdetls(){ 
 		 return $this->m_Rectdetls;
	}

	public function setRectamount($value){  
 		 $this->m_Rectamount=$value;
	}

	public function getRectamount(){ 
 		 return $this->m_Rectamount;
	}

	public function setCancelled($value){  
 		 $this->m_Cancelled=$value;
	}

	public function getCancelled(){ 
 		 return $this->m_Cancelled;
	}

	public function setCreatedon($value){  
 		 $this->m_Createdon=$value;
	}

	public function getCreatedon(){ 
 		 return $this->m_Createdon;
	}

	public function setCreatedby($value){  
 		 $this->m_Createdby=$value;
	}

	public function getCreatedby(){ 
 		 return $this->m_Createdby;
	}

}
 ?>

