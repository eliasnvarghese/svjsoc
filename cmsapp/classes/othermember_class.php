
<?php 
class OtherMember
{
	private $m_UId;   //UId 
	private $m_MemberId;   //m_MemberId 
	private $m_Name;   //Name 
	private $m_Gender;   //Gender 
	private $m_Dob;   //Dob 
	private $m_Relation;   //Relation 
	public function __construct(){
		$this->m_MemberId=0;  
		$this->m_UId=0;  
		$this->m_Name='';  
		$this->m_Gender='';  
		$this->m_Dob='';  
		$this->m_Relation='';  

	}

	public function setUId($value){  
 		 $this->m_UId=$value;
	}

	public function getUId(){ 
 		 return $this->m_UId;
	}
	
	public function setMemberId($value){  
 		 $this->m_MemberId=$value;
	}

	public function getMemberId(){ 
 		 return $this->m_MemberId;
	}

	public function setName($value){  
 		 $this->m_Name=$value;
	}

	public function getName(){ 
 		 return $this->m_Name;
	}

	public function setGender($value){  
 		 $this->m_Gender=$value;
	}

	public function getGender(){ 
 		 return $this->m_Gender;
	}

	public function setDob($value){  
 		 $this->m_Dob=$value;
	}

	public function getDob(){ 
 		 return $this->m_Dob;
	}

	public function setRelation($value){  
 		 $this->m_Relation=$value;
	}

	public function getRelation(){ 
 		 return $this->m_Relation;
	}

}
 ?>

