
<?php 
class Appointment
{
	private $m_Appointid;   //Appointid 
	private $m_Client_id;   //Client_id 
	private $m_Regno;   //Regno 
	private $m_Appointdate;   //Appointdate 
	private $m_Details;   //Details 
	private $m_Confirmed;   //Confirmed 
	private $m_Confirmeddate;   //Confirmeddate 
	private $m_Createdon;   //Createdon 
	private $m_Createdby;   //Createdby 
	public function __construct(){
		$this->m_Appointid='';  
		$this->m_Client_id='';  
		$this->m_Regno='';  
		$this->m_Appointdate='';  
		$this->m_Details='';  
		$this->m_Confirmed='';  
		$this->m_Confirmeddate='';  
		$this->m_Createdon='';  
		$this->m_Createdby='';  

	}

	public function setAppointid($value){  
 		 $this->m_Appointid=$value;
	}

	public function getAppointid(){ 
 		 return $this->m_Appointid;
	}

	public function setClient_id($value){  
 		 $this->m_Client_id=$value;
	}

	public function getClient_id(){ 
 		 return $this->m_Client_id;
	}

	public function setRegno($value){  
 		 $this->m_Regno=$value;
	}

	public function getRegno(){ 
 		 return $this->m_Regno;
	}

	public function setAppointdate($value){  
 		 $this->m_Appointdate=$value;
	}

	public function getAppointdate(){ 
 		 return $this->m_Appointdate;
	}

	public function setDetails($value){  
 		 $this->m_Details=$value;
	}

	public function getDetails(){ 
 		 return $this->m_Details;
	}

	public function setConfirmed($value){  
 		 $this->m_Confirmed=$value;
	}

	public function getConfirmed(){ 
 		 return $this->m_Confirmed;
	}

	public function setConfirmeddate($value){  
 		 $this->m_Confirmeddate=$value;
	}

	public function getConfirmeddate(){ 
 		 return $this->m_Confirmeddate;
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
$AppointmentObj = new Appointment();
$AppointmentObj->setAppointid($row['appointid']);
$AppointmentObj->setClient_id($row['client_id']);
$AppointmentObj->setRegno($row['regno']);
$AppointmentObj->setAppointdate($row['appointdate']);
$AppointmentObj->setDetails($row['details']);
$AppointmentObj->setConfirmed($row['confirmed']);
$AppointmentObj->setConfirmeddate($row['confirmeddate']);
$AppointmentObj->setCreatedon($row['createdon']);
$AppointmentObj->setCreatedby($row['createdby']);
