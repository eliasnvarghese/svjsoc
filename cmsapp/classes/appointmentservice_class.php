<?php
class AppointmentService
{
	private $log;
 	public function __construct() {
 		$this->log=new Logging();
 	}
 
	public function add($ObjAppointment){
			$query = "insert into appointment_t (" 
						. "client_id, regno, appointdate, confirmed, details,createdby)" 
					. "values( " 
					. quote($_SESSION['edp_userData_ClientId']).","
					. quote($ObjAppointment->getRegno()) . "," 
					. quote(date("Y-m-d",strtotime($ObjAppointment->getAppointdate()))) . "," 
					. " 0 ," 
					. quote($ObjAppointment->getDetails()) . "," 
					. quote($ObjAppointment->getCreatedby()) 
					. ")";
			return $this->executeInsert($query,"addAppointment");
	}
	public function update($ObjAppointment){
		$query = "update appointment_t set " 
				. " appointdate = " . quote(date("Y-m-d",strtotime($ObjAppointment->getAppointdate()))) . "," 
				. " details = " . quote($ObjAppointment.getDetails()) 
				. " where appointid = " . quote($ObjAppointment.getAppointid()) ." and client_id = ".quote($_SESSION['edp_userData_ClientId']);
		return $this->executeUpdate($query,"add");
	}
	public function confirm($appointid){
		$query = "update appointment_t set confirmed=1,confirmeddate = " . quote(date("Y-m-d")) 
				. " where appointid = " . quote($appointid) . " and confirmed = 0 " ." and client_id = ".quote($_SESSION['edp_userData_ClientId']);
		 return $this->executeUpdate($query,"confirm");  
	}
	public function undoConfirm($appointid){
		$query = "update appointment_t set confirmed=0 "
					." where appointid = " . quote($appointid) . " and confirmed = 1 " ." and client_id = ".quote($_SESSION['edp_userData_ClientId']);
		return $this->executeUpdate($query,"undoConfirm");  
	}

	public function attended($appointid){
			$query = "update appointment_t set confirmed=2 "
					." where appointid = " . quote($appointid)  ." and client_id = ".quote($_SESSION['edp_userData_ClientId']);
		return $this->executeUpdate($query,"attended");  
	}
	public function delAppointment($appointid){
		$query = "delete from appointment_t where appointid  = " . quote($appointid)  ." and client_id = ".quote($_SESSION['edp_userData_ClientId']);
		return $this->executeUpdate($query,"delAppointment"); 
	}
	public function getAppointment($appointid){
		$query = "select appointid, client_id, regno, appointdate, details, confirmed, confirmeddate, createdon, createdby " 
				. " from appointment_t " 
					. " where appointid  = " . quote($appointid)  ." and client_id = ".quote($_SESSION['edp_userData_ClientId']);
		$ObjAppointment=null;
		$results=$this->executeQuery($query,"getAppointment");
		while($row=mysqli_fetch_array($results)){ 
			$ObjAppointment = new Appointment();
			$ObjAppointment->setAppointid($row['appointid']);
			$ObjAppointment->setClient_id($row['client_id']);
			$ObjAppointment->setRegno($row['regno']);
			$ObjAppointment->setAppointdate($row['appointdate']);
			$ObjAppointment->setDetails($row['details']);
			$ObjAppointment->setConfirmed($row['confirmed']);
			$ObjAppointment->setConfirmeddate($row['confirmeddate']);
			$ObjAppointment->setCreatedon($row['createdon']);
			$ObjAppointment->setCreatedby($row['createdby']);
		}
		return $ObjAppointment;
	}

	public function isExists($regno, $dt){
		$query = "select appointid  from appointment_t " 
					. " where " 
						. "regno= " . quote($regno) . " and year(appointdate) = " . quote(date("Y",strtotime(dt)))
						. " and month(appointdate) = " . quote(date("m",strtotime(dt)))	. " and day(appointdate) = " . quote(date("d",strtotime(dt)))  
						." and client_id = ".quote($_SESSION['edp_userData_ClientId']);
			$results=$this->executeQuery($query,"getAppointment");
			if(mysqli_num_rows($results)>0)
				return true;
			return false;
	}

	public function isExistsInOther($regno, $dt, $appointid){
			$query = "select appointid  from appointment_t " 
					. " where " 
						. "regno= " . quote($regno) . " and year(appointdate) = " . quote(date("Y",strtotime(dt)))
						. " and month(appointdate) = " . quote(date("m",strtotime(dt)))	. " and day(appointdate) = " . quote(date("d",strtotime(dt)))  
						. " and appointid <> " . quote($appointid)
						. " and client_id = ".quote($_SESSION['edp_userData_ClientId']);
			$results=$this->executeQuery($query,"getAppointment");
			if(mysqli_num_rows($results)>0)
				return true;
			return false;
	}

	public function getSchedule($regno) {
		$query = "select appointid, client_id, regno ,appointdate, details,confirmed, createdon,createdby " 
					. " from appointment_t " 
						. " where regno = " . quote($regno) . " and client_id = ".quote($_SESSION['edp_userData_ClientId'])
						. " order by appointdate desc ";
		return $this->executeQuery($query,"getAppointment");
	}

	public function getTodaysAppointmentList($dt){
		$frmdt=$dt;
		$todt=addDaysWithDate($dt,1);
		$query = "select " 
				. "a.regno ,a.regdate, a.patientname ,a.address1 ,a.address2 ,a.city ,a.state ,a.pin ,a.landphone ,a.mobileno ,"
				."a.dateofbirth ,a.gender ,a.createdon, a.createdby ,b.appointid, b.appointdate, b.details,b.confirmed" 
					. " from patient_t a, appointment_t b " 
				. " where " 
					. " b.appointdate >= " . quote($frmdt) . " and b.appointdate < " . quote($todt) 
					. " and a.regno=b.regno " . " and a.client_id = ".quote($_SESSION['edp_userData_ClientId'])
						. " order by b.appointdate ";
		return $this->executeQuery($query,"getAppointment");
	}

	public function getTodaysCompletedAppointments($dt) {
		$frmdt=$dt;
		$todt=addDaysWithDate($dt,1);
		$query = "Select " 
				."a.regno ,a.regdate, a.patientname ,a.address1 ,a.address2 ,a.city ,a.state ,a.pin ,a.landphone ,a.mobileno ,"
				."a.dateofbirth ,a.gender ,a.createdon, a.createdby ,b.appointid, b.appointdate, b.details,b.confirmed" 
					. " from patient_t a, appointment_t b " 
					. " where " 
					. " b.appointdate >= " . quote($frmdt) . " and b.appointdate < " . quote($todt) 
						. " and b.confirmed = 2 " . " and a.regno=b.regno " . " and a.client_id = ".quote($_SESSION['edp_userData_ClientId'])
						 . " order by b.appointdate ";
		return $this->executeQuery($query,"getAppointment");
	}
	public function getTodaysConfirmedAppointments($dt){
		$frmdt=$dt;
		$todt=addDaysWithDate($dt,1);
		$query = "select " 
				."a.regno ,a.regdate, a.patientname ,a.address1 ,a.address2 ,a.city ,a.state ,a.pin ,a.landphone ,a.mobileno ,"
				."a.dateofbirth ,a.gender ,a.createdon, a.createdby ,b.appointid, b.appointdate, b.details,b.confirmed" 
					. " from patient_t a, appointment_t b " 
					. " where " 
					. " b.appointdate >= " . quote($frmdt) . " and b.appointdate < " . quote($todt) 
						. " and b.confirmed = 1 " . " and a.regno=b.regno " . " and a.client_id = ".quote($_SESSION['edp_userData_ClientId'])
						 . " order by b.appointdate ";
		return $this->executeQuery($query,"getAppointment");
	}

	public function getAppointmentList($frmdt, $todt){
		$todt=addDaysWithDate($todt,1);
		$query = "select " 
				. " a.regno ,a.regdate, a.patientname ,a.address1 ,a.address2 ,a.city ,a.state ,a.pin ,a.landphone ,a.mobileno ,"
				."a.dateofbirth ,a.gender ,a.createdon, a.createdby ,b.appointid, b.appointdate, b.details,b.confirmed" 
					. " from patient_t a, appointment_t b " 
				. " where " 
					. " b.appointdate >= " . quote($frmdt) . " and b.appointdate < " . quote($todt) 
					. " and a.regno=b.regno " . " and a.client_id = ".quote($_SESSION['edp_userData_ClientId'])
						. " order by b.appointdate ";
		return $this->executeQuery($query,"getAppointment");
	}
	public function getAppointmentListCount($frmdt){
		//$todt=addDaysWithDate($todt,1);
		$query = "select " 
				. " b.appointdate,count(b.regno) as cnt " 
					. " from appointment_t b " 
				. " where " 
					. " b.appointdate >= " . quote($frmdt) 
					. " and b.client_id = ".quote($_SESSION['edp_userData_ClientId'])
					." group by b.appointdate";
						
		return $this->executeQuery($query,"getAppointmentListCount");
	}
	public function getScheduleSummary($frmdt, $todt){
		$todt=addDaysWithDate($dt,1);
		$query = "select " 
				. "year(appointdate),month(appointdate),day(appointdate),count(*) as cnt from appointment_t " 
				. " where " 
					. " appointdate >= " . quote($frmdt) . " and appointdate < " . quote($todt) 
					 . " and client_id = ".quote($_SESSION['edp_userData_ClientId'])
					 . " group by year(appointdate),month(appointdate),day(appointdate) ";
			return $this->executeQuery($query,"getAppointment");
	}

	/***** Private functions ***/
 	private function executeQuery($query,$agent=""){
 		try{
 			$this->log->debugLog($agent.": ".$query);
 			$this->sqlExec = new SqlExecution();
 			$this->sqlExec->executeQuery($query);
 			return $this->sqlExec->getResults();
 		}
 		catch(Exception $e) {
 			throw new Exception("Error while query execute..".$e->getMessage());
 		}
 	}
 	private function executeInsert($query,$agent="",$idRequired=true){
 		try{
 			$this->log->debugLog($agent.": ".$query);
 			$this->sqlExec = new SqlExecution();
 			if($this->sqlExec->execute($query)){
 				if($idRequired)
 					return mysqli_insert_id($this->sqlExec->getConn());
 				return 1;
 			}
 			return 0;
 		}
 		catch(Exception $e) {
 			throw new Exception("Error while Insert..".$e->getMessage());
 		}
 	}
 	private function executeUpdate($query,$agent=""){
 		try{
 			$this->log->debugLog($agent.": ".$query);
 			$this->sqlExec = new SqlExecution();
 			if($this->sqlExec->execute($query)){
 				return mysqli_affected_rows($this->sqlExec->getConn());
 			}
 			return 0;
 		}
 		catch(Exception $e) {
 			throw new Exception("Error while update..".$e->getMessage());
 		}
 	}
}
	?>